<?php


namespace App\Http\Repository\PersonnalManage;

use App\Model\DepartmentManage;

class DepartmentManageRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'department_manage_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 新增、编辑部门信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author kfccPeng
     * 2020-2-5 15:48
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return DepartmentManage::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 部门详情
     * describe 查看部门信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author kfccPeng
     * 2020-2-5 15:49
     */
    public function item($id)
    {
        //查询缓存
        $cache = $this->_redis->get(self::CACHE_KEY_RULE_PRE . $id);

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            //
            $query = DepartmentManage::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 部门删除
     * describe 删除部门信息
     * @param $id
     * @return mixed
     * @author kfccPeng
     * 2020-2-5 15:51
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return DepartmentManage::query()->where('id', $id)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author kfccPeng
     * 2020-2-5 15:51
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
     * function 部门数据列表
     * describe 部门数据列表
     * @param $page
     * @param $page_size
     * @return mixed
     * @author kfccPeng
     * 2020-2-5 16:28
     */
    public function list($page, $page_size)
    {

        return DepartmentManage::query()->paginate($page_size);
    }

    /**
     * function 部门数据批量删除
     * describe 部门数据批量删除
     * @param $ids
     * @return mixed
     * @author kfccPeng
     * 2020-2-5 16:29
     */
    public function batchDelete($ids)
    {
        return DepartmentManage::query()->whereIn('id', $ids)->delete();
    }
}