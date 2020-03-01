<?php


namespace App\Http\Repository\MemberManagement;


use App\Common\CommonFunc;
use App\Model\CheckOut;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CheckOutRepository
{
    /**
     * 新增或者更新床位相关信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        $params['expense_item'] = json_encode($params['expense_item']) ?? '';
        return CheckOut::query()
            ->updateOrCreate(['id' => $id], $params);
    }

    /**
     * 查询单个床位信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        return CheckOut::query()
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
        return CheckOut::query()
            ->paginate($pageSize);
    }

    /**
     * 取消预约订单
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return CheckOut::query()
            ->where('id', $id)
            ->delete();
    }

    /**
     * 根据人名或者手机号搜索会员
     * @param $params
     * @return Builder[]|Collection
     */
    public function search($params)
    {
        return CheckOut::query()
            ->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params).'%')
            ->get();
    }

    /**
     * function 固定资产数据批量删除
     * describe 固定资产数据批量删除
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        return CheckOut::query()
            ->whereIn('id', $ids)
            ->delete();
    }


}