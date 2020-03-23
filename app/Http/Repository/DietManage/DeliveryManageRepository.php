<?php


namespace App\Http\Repository\DietManage;

use App\Model\DeliveryManage;

class DeliveryManageRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'delivery_manage_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 新增、编辑配送信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author kfccPeng
     * 2020-03-22 18:16
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return DeliveryManage::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 配送详情
     * describe 查看配送信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author kfccPeng
     * 2020-03-22 18:17
     */
    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            $query = DeliveryManage::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 配送删除
     * describe 删除配送信息
     * @param $id
     * @return mixed
     * @author kfccPeng
     * 2020-03-22 18:17
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return DeliveryManage::query()->where('id', $id)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author kfccPeng
     * 2020-03-22 18:18
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
     * function 配送数据列表
     * describe 配送数据列表
     * @param $page
     * @param $page_size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author kfccPeng
     * 2020-03-22 18:18
     */
    public function list($page, $page_size)
    {
        return DeliveryManage::query()->paginate($page_size);
    }

    /**
     * function 配送数据批量删除
     * describe 配送数据批量删除
     * @param $ids
     * @return mixed
     * @author kfccPeng
     * 2020-03-22 18:19
     */
    public function batchDelete($ids)
    {
        return DeliveryManage::query()->whereIn('id', $ids)->delete();
    }

    /**
     * function 配送
     * describe 配送
     * @param $id
     * @return int
     * @author kfccPeng
     * 2020-03-22 18:19
     */
    public function delivery($id)
    {
        $result = DeliveryManage::query()->where('id', $id)->first();

        if(!$result){
            return 0;
        }elseif($result['type'] == 1){
            return 1;
        }

        $params['type'] = 1;
        $data = DeliveryManage::query()->updateOrCreate(['id' => $id], $params);
        //清除缓存
        $this->cleanCache($id);

        return 2;
    }
}