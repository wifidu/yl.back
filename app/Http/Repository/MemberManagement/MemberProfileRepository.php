<?php


namespace App\Http\Repository\MemberManagement;

use App\Common\CommonFunc;
use App\Model\MemberProfile;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberProfileRepository
 * 会员档案处理资源类
 * @package App\Http\Repository\MemberProfileController
 * @author YanJiGang
 */
class MemberProfileRepository
{

    /**
     * 新增会员或者更新会员相关信息
     * @param $params
     * @return Model
     */
    public function store($params)
    {
        $id = $params['id'] ?? '';

        return MemberProfile::query()
            ->updateOrCreate(['id' => $id], $params);
    }

    /**
     * 查询单个用户信息
     * @param $id
     * @return Builder|Model|object|null
     */
    public function item($id)
    {
        $msg =  MemberProfile::query()
            ->where('id', '=', $id)
            ->where('is_del', '=', 0)
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
        return MemberProfile::query()
            ->where('is_del', '=', '0')
            ->paginate($pageSize);
    }


    /**
     * 软删除一个会员
     * @param $id
     * @return int
     */
    public function delete($id)
    {
        return MemberProfile::query()
            ->where('id', $id)
            ->update(['is_del' => 1 ]);
    }


    /**
     * 根据人名或者手机号搜索会员
     * @param $params
     * @return Builder[]|Collection
     */
    public function search($params)
    {
        return MemberProfile::query()
            ->when(isset($params['member_name']), function ($query) use ($params) {
                return $query->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params['member_name']).'%');
            })
            ->when(isset($params['phone_number']), function ($query) use ($params) {
                return $query->where('phone_number', '=', $params['phone_number']);
            })
            ->get();

    }

}