<?php


namespace App\Http\Repository\MemberManagement;


use App\Common\CommonFunc;
use App\Model\OutManage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class OutManageRepository
{
    /**
     * 新增或者更新外出相关信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        $params['expense_item'] = json_encode($params['expense_item']) ?? '';
        return OutManage::query()
            ->updateOrCreate(['id' => $id], $params);
    }

    /**
     * 查询单个外出信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        return OutManage::query()
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
        return OutManage::query()
            ->paginate($pageSize);
    }

    /**
     * 删除单条记录
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return OutManage::query()
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
        return OutManage::query()
            ->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params).'%')
            ->get();
    }

    /**
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        return OutManage::query()
            ->whereIn('id', $ids)
            ->delete();
    }

}