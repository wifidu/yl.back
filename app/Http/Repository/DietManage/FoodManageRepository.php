<?php


namespace App\Http\Repository\DietManage;

use App\Model\FoodManage;

class FoodManageRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'food_manage_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 新增、编辑单品信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author kfccPeng
     * 2020-02-29 18:43
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return FoodManage::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 单品详情
     * describe 查看单品信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author kfccPeng
     * 2020-02-29 18:44
     */
    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            $query = FoodManage::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 单品删除
     * describe 删除单品信息
     * @param $id
     * @return mixed
     * @author kfccPeng
     * 2020-02-29 18:45
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return FoodManage::query()->where('id', $id)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author kfccPeng
     * 2020-02-29 18:45
     */
    private function cleanCache($id)
    {
        $keys = $this->_redis->keys(self::CACHE_KEY_RULE_PRE . $id);
        // 缓存也删除
        if ($keys) {
            $this->_redis->del($keys);
        }
    }

    /**
     * function 单品数据列表
     * describe 单品数据列表
     * @param $page
     * @param $page_size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author kfccPeng
     * 2020-02-29 18:46
     */
    public function list($page, $page_size)
    {
        return FoodManage::query()->paginate($page_size);
    }

    /**
     * function 单品数据批量删除
     * describe 单品数据批量删除
     * @param $ids
     * @return mixed
     * @author kfccPeng
     * 2020-02-29 18:46
     */
    public function batchDelete($ids)
    {
        return FoodManage::query()->whereIn('id', $ids)->delete();
    }

    /**
     * function 改变单品状态
     * describe 改变单品状态
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|string
     * @author kfccPeng
     * 2020-03-01 19:15
     */
    public function typeChange($id)
    {
        $result = FoodManage::query()->where('id', $id)->first();
        if(!$result){
            return '';
        }
        $params['food_type'] = !$result['food_type'];
        $data = FoodManage::query()->updateOrCreate(['id' => $id], $params);
        //清除缓存
        $this->cleanCache($id);

        return $data;
    }
}