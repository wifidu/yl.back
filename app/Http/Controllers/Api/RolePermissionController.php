<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use App\Traits\ApiTraits;
use Dingo\Api\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RolePermissionController extends Controller
{
    use ApiTraits;

    /**
     * function 添加角色
     * describe 添加角色
     * @param Request $request
     * @param Role $role
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/16 下午9:40
     */
    public function addRole(Request $request,Role $role)
    {
        $role_name    = $request->all()['name'];
        $result       = $role::findOrCreate($role_name,"web");
        return $this->apiReturn($result,CodeEnum::INC_SUCCESS);
    }

    /**
     * function 所有权限列表
     * describe 所有权限列表
     * @param Permission $permission
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/16 下午9:41
     */
    public function list(Permission $permission)
    {
        return $this->apiReturn($permission::all(),CodeEnum::SUCCESS);
    }

    /**
     * function 赋予角色权限
     * describe 赋予角色权限
     * @param Request $request
     * @param Role $role
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/16 下午9:41
     */
    public function givePermissionToRole(Request $request,Role $role)
    {
        $role_id    = $request->all()['id'];
        $permission = $request->all()['permission'];
        $role       = $role::find($role_id);
        if ($role){
            $result     = $role->givePermissionTo($permission);
            return $this->apiReturn($result,CodeEnum::SUCCESS);
        }
        return $this->apiReturn('',CodeEnum::USER_NOT_EXISTENT);
    }

    /**
     * function 取消角色权限
     * describe 取消角色权限
     * @param Request $request
     * @param Role $role
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/16 下午9:41
     */
    public function revokePermissionToRole(Request $request,Role $role)
    {
        $role_id    = $request->all()['id'];
        $permission = $request->all()['permission'];
        $role       = $role::find($role_id);
        if ($role){
            $result     = $role->revokePermissionTo($permission);
            return $this->apiReturn($result,CodeEnum::SUCCESS);
        }
        return $this->apiReturn('',CodeEnum::USER_NOT_EXISTENT);
    }

    /**
     * function 获取当前角色权限
     * describe 获取当前角色权限
     * @param Request $request
     * @param Role $role
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/16 下午9:42
     */
    public function roleHavePermisson(Request $request,Role $role)
    {
        $role_id    = $request->all()['id'];
        $role       = $role::find($role_id);
        if ($role){
            $permisson  = $role->getAllPermissions();
            return $this->apiReturn($permisson,CodeEnum::SUCCESS);
        }
        return $this->apiReturn('',CodeEnum::USER_NOT_EXISTENT);
    }
}
