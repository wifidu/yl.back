<?php


namespace App\Http\Repository\MemberManagement;


use App\Model\BookBed;
use App\Common\CommonFunc;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BookBedRepository
{
    /**
     * 新增或者更新床位相关信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';
        $is_check = $params['is_checkin'] ?? 0;

        return BookBed::query()
            ->updateOrCreate(['id' => $id, 'is_checkin' => $is_check], $params);
    }

    /**
     * 查询单个床位信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        $msg = BookBed::query()
            ->where('id', '=', $id)
            ->where('is_cancel', '=', 0)
            ->first();
        return $msg;
    }

    /**
     * 分页显示结果
     * @param $pageSize
     * @return LengthAwarePaginator
     */
    public function list($pageSize)
    {
        return BookBed::query()
            ->where('is_cancel', '=', 0)
            ->paginate($pageSize);
    }
    
    /**
     * 取消预约订单
     * @param $id
     * @return int
     */
    public function cancel($id)
    {
        return BookBed::query()
            ->where('id', $id)
            ->where('is_checkin', 0)
            ->update(['is_cancel' => 1 ]);
    }

    /**
     * 根据人名或者手机号搜索会员
     * @param $params
     * @return Builder[]|Collection
     */
    public function search($params)
    {
        return BookBed::query()
            ->when(isset($params['elderly_name']), function ($query) use ($params) {
                return $query->where('elderly_name', 'like', '%'.CommonFunc::escapeLikeStr($params['elderly_name']).'%')
                    ->where('is_cancel', '=', '0');
            })
            ->when(isset($params['contract_number']), function ($query) use ($params) {
                return $query->where('contract_number', '=', $params['contract_number'])
                    ->where('is_cancel', '=', '0');
            })
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
        return BookBed::query()
            ->whereIn('id', $ids)
            ->delete();
    }


}