<?php


namespace App\Http\Repository\MaterialManagement;

use App\Model\FixedAssets;

class FixedAssetsRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'fixed_assets_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 固定资产数据存储或更新
     * describe 固定资产数据存储或更新
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:30
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return FixedAssets::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 固定资产数据详情
     * describe 固定资产数据详情
     * @param $id 数据项id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:31
     */
    public function item($id)
    {
        //查询缓存
        $cache = $this->_redis->get(self::CACHE_KEY_RULE_PRE . $id);

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            //
            $query = FixedAssets::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 固定资产数据列表
     * describe 固定资产数据列表
     * @param $page 当前页数
     * @param $page_size 每页大小
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:31
     */
    public function list($page, $page_size)
    {

        return FixedAssets::query()->paginate($page_size);
    }

    /**
     * function 固定资产数据删除
     * describe 固定资产数据删除
     * @param $id 数据项id
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:32
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return FixedAssets::query()->where('id', $id)->delete();
    }

    /**
     * function 固定资产数据批量删除
     * describe 固定资产数据批量删除
     * @param $ids 多个数据想项id
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:32
     */
    public function batchDelete($ids)
    {
        return FixedAssets::query()->whereIn('id', $ids)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:32
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