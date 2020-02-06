<?php


namespace App\Http\Repository\MemberProfile;

use App\Common\CommonFunc;
use App\MemberProfile;

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
     * @return \Illuminate\Database\Eloquent\Model
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
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
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
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
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
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function search($params)
    {
        return MemberProfile::query()
            ->where(function ($query) use ($params) {
                $query->where('member_name', 'like', '%'.CommonFunc::escapeLikeStr($params).'%')
                    ->where('is_del', '=', '0');
            })
            ->orWhere(function ($query) use ($params) {
                $query->where('phone_number', '=', $params)
                    ->where('is_del', '=', '0');
            })
            ->get();

    }

}