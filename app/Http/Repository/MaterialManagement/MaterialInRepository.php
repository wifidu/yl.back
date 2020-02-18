<?php


namespace App\Http\Repository\MaterialManagement;

use App\Model\MaterialIn;

class MaterialInRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'material_in_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 物资数据存储或更新
     * describe 物资数据存储或更新
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:12
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';
        return MaterialIn::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 物资数据详情
     * describe 物资数据详情
     * @param $id 物资项id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:15
     */
    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            //
            $query = MaterialIn::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 物资数据列表
     * describe 物资数据列表
     * @param $page 当前页数
     * @param $page_size 页面大小
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:17
     */
    public function list($page, $page_size)
    {

        return MaterialIn::query()->paginate($page_size);
    }

    /**
     * function 物资数据删除
     * describe 物资数据删除
     * @param $id 物资项id
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:21
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return MaterialIn::query()->where('id', $id)->delete();
    }

    /**
     * function 物资数据批量删除
     * describe 物资数据批量删除
     * @param $ids 物资项id
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:22
     */
    public function batchDelete($ids)
    {
        return MaterialIn::query()->whereIn('id', $ids)->delete();
    }

    /**
     * function 清除缓存
     * describe 清除缓存
     * @param $id
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:23
     */
    private function cleanCache($id)
    {
        $keys = $this->_redis->keys(self::CACHE_KEY_RULE_PRE . $id);
        // 缓存也删除
        if ($keys) {
            $this->_redis->del($keys);
        }
    }
}