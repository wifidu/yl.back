<?php


namespace App\Http\Repository\MedicineManage;


use App\Common\CommonFunc;
use App\Model\MedicineDeposit;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class MedicineDepositRepository
{
    /**
     * 新增或者更新药品相关信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return MedicineDeposit::query()
            ->updateOrCreate(['id' => $id], $params);
    }


    /**
     * 查询单个药品信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        return MedicineDeposit::query()
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
        return MedicineDeposit::query()
            ->paginate($pageSize);
    }

    /**
     * 删除单条记录
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return MedicineDeposit::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * 根据人名或者手机号搜索药品
     * @param $params
     * @return Builder[]|Collection
     */
    public function search($params)
    {
        return MedicineDeposit::query()
            ->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params).'%')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        return MedicineDeposit::query()
            ->whereIn('id', $ids)
            ->delete();
    }
}