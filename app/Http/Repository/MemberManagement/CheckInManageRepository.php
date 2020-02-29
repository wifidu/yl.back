<?php


namespace App\Http\Repository\MemberManagement;


use App\Common\CommonFunc;
use App\Model\CheckInManage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class CheckInManageRepository
{
    /**
     * 新增或者更新入住登记相关信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        $params['meal_cost'] = json_encode($params['meal_cost']);
        $params['bed_cost'] = json_encode($params['bed_cost']);
        $params['one-time_cost'] = json_encode($params['one-time_cost']);

        return CheckInManage::query()
            ->updateOrCreate(['id' => $id], $params);
    }

    /**
     * 查询单个入住登记信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        return CheckInManage::query()
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
        return CheckInManage::query()
            ->paginate($pageSize);
    }

    /**
     * 删除入住登记
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return CheckInManage::query()
            ->where('id', '=', $id)
            ->delete();
    }

    /**
     * 根据人名搜索会员查找其入住登记
     * @param $params
     * @return Builder[]|Collection
     */
    public function search($params)
    {
        return CheckInManage::query()
            ->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params).'%')
            ->get();
    }

    /**
     * 批量删除入住登记
     * @param $ids
     * @return mixed
     */
    public function batchDelete($ids)
    {
        return CheckInManage::query()
            ->whereIn('id', $ids)
            ->delete();
    }

    /**
     * 上传文件处理
     * @param $id
     * @param $path
     * @return int
     */
    public function upload($id, $path)
    {
        return CheckInManage::query()
            ->where('id', '=', $id)
            ->update(['medical_port_path' => $path]);
    }

    /**
     * 业务变更以及膳食变更
     * @param $params
     * @return int|null
     */
    public function change($params)
    {
        if (isset($params['bed_cost'])) {
            $params['bed_cost'] = json_encode($params['bed_cost']);
            return CheckInManage::query()
                ->where('id', '=', $params['id'])
                ->update([
                    'business_change_reason' => $params['reason'],
                    'business_change_date'   => $params['date'],
                    'bed_cost'               => $params['bed_cost']
                    ]);
        } elseif (isset($params['meal_cost'])) {
            $params['meal_cost'] = json_encode($params['meal_cost']);
            return CheckInManage::query()
                ->where('id', '=', $params['id'])
                ->update([
                    'meal_change_reason' => $params['reason'],
                    'meal_change_date'   => $params['date'],
                    'meal_cost'          => $params['meal_cost']
                ]);
        } else {
            return null;
        }
    }
}