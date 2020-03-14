<?php


namespace App\Http\Repository\MemberManagement;


use App\Common\CommonFunc;
use App\Model\DeathRegistration;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DeathRegistrationRepository
{
    /**
     * 新增或者更新死亡登记信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return DeathRegistration::query()
            ->updateOrCreate(['id' => $id], $params);
    }

    /**
     * 查询单个死亡登记信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        return DeathRegistration::query()
            ->where('id', '=', $id)
            ->first();
    }

    /**
     * 分页显示结果
     * @param $pageSize
     * @return LengthAwarePaginator
     */
    public function list($pageSize)
    {
        return DeathRegistration::query()
            ->paginate($pageSize);
    }

    /**
     * 删除单条记录
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return DeathRegistration::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * 根据人名或者手机号搜索死亡登记
     * @param $params
     * @return Builder[]|Collection
     */
    public function search($params)
    {
        return DeathRegistration::query()
            ->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params).'%')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        return DeathRegistration::query()
            ->whereIn('id', $ids)
            ->delete();
    }

}