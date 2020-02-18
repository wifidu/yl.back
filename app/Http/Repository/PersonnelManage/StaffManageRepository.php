<?php


namespace App\Http\Repository\PersonnelManage;

use App\Model\StaffManage;
use Illuminate\Support\Facades\DB;

class StaffManageRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'staff_manage_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 新增、编辑员工信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author kfccPeng
     * 2020-2-17 17:39
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return StaffManage::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 员工详情
     * describe 查看员工信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author kfccPeng
     * 2020-2-17 17:39
     */
    public function item($id)
    {
        //查询缓存
        $cache = $this->_redis->get(self::CACHE_KEY_RULE_PRE . $id);

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            //
            $query = StaffManage::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 员工删除
     * describe 删除员工信息
     * @param $id
     * @return mixed
     * @author kfccPeng
     * 2020-2-17 17:46
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return StaffManage::query()->where('id', $id)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author kfccPeng
     * 2020-2-17 17:48
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
     * function 员工数据列表
     * describe 员工数据列表
     * @param $page
     * @param $page_size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author kfccPeng
     * 2020-2-17 17:48
     */
    public function list($page, $page_size)
    {
        return StaffManage::query()->paginate($page_size);
    }

    /**
     * function 员工数据批量删除
     * describe 员工数据批量删除
     * @param $ids
     * @return mixed
     * @author kfccPeng
     * 2020-2-17 17:49
     */
    public function batchDelete($ids)
    {
        return StaffManage::query()->whereIn('id', $ids)->delete();
    }
}