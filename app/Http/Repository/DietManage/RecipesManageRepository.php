<?php


namespace App\Http\Repository\DietManage;

use App\Model\RecipesManage;

class RecipesManageRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'recipes_manage_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 新增、编辑膳食信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return \Illuminate\Database\Eloquent\Model
     * @author kfccPeng
     * 2020-03-13 22:39
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return RecipesManage::query()->updateOrCreate(['id' => $id], $params);
    }

    /**
     * function 膳食详情
     * describe 查看膳食信息
     * @param $id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author kfccPeng
     * 2020-03-13 22:39
     */
    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)) {
            $query = RecipesManage::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 膳食删除
     * describe 删除膳食信息
     * @param $id
     * @return mixed
     * @author kfccPeng
     * 2020-03-13 22:40
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return RecipesManage::query()->where('id', $id)->delete();
    }

    /**
     * function 删除缓存
     * describe 删除缓存
     * @param $id
     * @author kfccPeng
     * 2020-03-13 22:40
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
     * function 膳食数据列表
     * describe 膳食数据列表
     * @param $page
     * @param $page_size
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author kfccPeng
     * 2020-03-13 22:40
     */
    public function list($page, $page_size)
    {
        return RecipesManage::query()->paginate($page_size);
    }

    /**
     * function 膳食数据批量删除
     * describe 膳食数据批量删除
     * @param $ids
     * @return mixed
     * @author kfccPeng
     * 2020-03-13 22:41
     */
    public function batchDelete($ids)
    {
        return RecipesManage::query()->whereIn('id', $ids)->delete();
    }

}