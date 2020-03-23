<?php


namespace App\Http\Repository\DietManage;

use App\Model\PackageManage;

class PackageManageRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'package_manage_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 新增、编辑套餐信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author kfccPeng
     * 2020-03-06 23:03
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return PackageManage::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 套餐详情
     * describe 查看套餐信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author kfccPeng
     * 2020-03-06 23:05
     */
    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            $query = PackageManage::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 套餐删除
     * describe 删除套餐信息
     * @param $id
     * @return mixed
     * @author kfccPeng
     * 2020-03-06 23:05
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return PackageManage::query()->where('id', $id)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author kfccPeng
     * 2020-03-06 23:06
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
     * function 套餐数据列表
     * describe 套餐数据列表
     * @param $page
     * @param $page_size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author kfccPeng
     * 2020-03-06 23:06
     */
    public function list($page, $page_size)
    {
        return PackageManage::query()->paginate($page_size);
    }

    /**
     * function 套餐数据批量删除
     * describe 套餐数据批量删除
     * @param $ids
     * @return mixed
     * @author kfccPeng
     * 2020-03-06 23:07
     */
    public function batchDelete($ids)
    {
        return PackageManage::query()->whereIn('id', $ids)->delete();
    }

    /**
     * function 预定套餐
     * describe 预定套餐
     * @param $id
     * @return \Illuminate\Database\Eloquent\Model|string
     * @author kfccPeng
     * 2020-03-06 23:07
     */
    public function order($id)
    {
        $data = PackageManage::query()->where('id', $id)->increment("reserve_number");

        //清除缓存
        $this->cleanCache($id);

        return $data;
    }
}