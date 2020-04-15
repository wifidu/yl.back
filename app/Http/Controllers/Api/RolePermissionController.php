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
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 添加角色
     * @description 添加角色的接口
     * @method `post` `application/json`
     * @url {{host}}/api/role-permission/addrole
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @param name 必选 string 角色名
     * @json_param {"name":"admin"}
     * @return {"status":201,"message":"新增成功","data":{"id":17,"name":"admin","guard_name":"web","created_at":"2020-03-24 13:37:06","updated_at":"2020-03-24 17:53:13"}}
     * @return_param id int 角色id
     * @return_param name string 角色名称
     * @return_param guard_name int 角色所属组
     * @remark
     */
    public function addRole(Request $request,Role $role)
    {
        $role_name    = $request->all()['name'];
        $result       = $role::findOrCreate($role_name,"web");
        return $this->apiReturn($result,CodeEnum::INC_SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 所有权限列表
     * @description 所有权限列表的接口
     * @method `get`
     * @url {{host}}/api/role-permission/list
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return {"status":200,"message":"操作成功","data":[{"id":1,"name":"material-management","guard_name":"web","created_at":"2020-03-24 11:03:12","updated_at":"2020-03-24 11:03:12","name_CN":"物资管理"},{"id":2,"name":"financial-management","guard_name":"web","created_at":"2020-03-24 11:03:13","updated_at":"2020-03-24 11:03:13","name_CN":"财务管理"},{"id":3,"name":"daily-management","guard_name":"web","created_at":"2020-03-24 11:03:14","updated_at":"2020-03-24 11:03:14","name_CN":"日常管理"},{"id":4,"name":"personnel-management","guard_name":"web","created_at":"2020-03-24 11:03:15","updated_at":"2020-03-24 11:03:15","name_CN":"人事管理"},{"id":5,"name":"diet-manage","guard_name":"web","created_at":"2020-03-24 11:03:16","updated_at":"2020-03-24 11:03:16","name_CN":"膳食管理"},{"id":6,"name":"member-management","guard_name":"web","created_at":"2020-03-24 11:03:16","updated_at":"2020-03-24 11:03:16","name_CN":"会员管理"},{"id":7,"name":"medicine-manage","guard_name":"web","created_at":"2020-03-24 11:03:17","updated_at":"2020-03-24 11:03:17","name_CN":"药品管理"},{"id":8,"name":"report-management","guard_name":"web","created_at":"2020-03-24 11:03:18","updated_at":"2020-03-24 11:03:18","name_CN":"报表管理"}]}
     * @return_param id int 权限id
     * @return_param name string 权限名称
     * @return_param guard_name int 权限所属组
     * @return_param name_CN int 权限中文名
     * @remark
     */
    public function list(Permission $permission)
    {
        $all_permission = $permission::all();
        $name_CN = config('module');
        foreach ($all_permission as $key => $value){
            $all_permission[$key]['name_CN'] = $name_CN[$value['name']];
        }
        return $this->apiReturn($all_permission,CodeEnum::SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 赋予角色权限
     * @description 赋予角色权限的接口
     * @method `post` `application/json`
     * @url {{host}}/api/role-permission/givepermisstorole
     * @param id 必选 string 角色id 即 获取用户信息接口中返回的 roles_id
     * @param permission 必选 string 为一个或一组权限
     * @json_param {"id":12,"permission":["personnel-management","material-management","financial-management"]}
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return  {"status":200,"message":"操作成功","data":{"id":17,"name":"admin","guard_name":"web","created_at":"2020-03-24 13:37:06","updated_at":"2020-03-24 17:53:13","permissions":[{"id":1,"name":"material-management","guard_name":"web","created_at":"2020-03-24 11:03:12","updated_at":"2020-03-24 11:03:12","pivot":{"role_id":17,"permission_id":1}},{"id":2,"name":"financial-management","guard_name":"web","created_at":"2020-03-24 11:03:13","updated_at":"2020-03-24 11:03:13","pivot":{"role_id":17,"permission_id":2}},{"id":4,"name":"personnel-management","guard_name":"web","created_at":"2020-03-24 11:03:15","updated_at":"2020-03-24 11:03:15","pivot":{"role_id":17,"permission_id":4}}]}}
     * @return_param id int 角色id
     * @return_param name string 角色名
     * @return_param guard_name int 角色所属组
     * @return_param permissions.id int 权限id
     * @return_param permissions.name int 权限名称
     * @return_param permissions.guard_name int 权限所属组
     * @return_param permissions.pivot.role_id int 权限所属角色id
     * @return_param permissions.pivot.permission_id int 权限id
     * @remark 角色id即获取用户信息接口中返回的roles_id
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
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 移除角色权限
     * @description 移除角色权限的接口
     * @method `post` `application/json`
     * @url {{host}}/api/role-permission/revokepermisstorole
     * @param id 必选 string 角色id 即 获取用户信息接口中返回的 roles_id
     * @param permission 必选 string 为一个或一组权限
     * @json_param {"id":17,"permission":["personnel-management","material-management","financial-management"]}
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return  {"status":200,"message":"操作成功","data":{"id":17,"name":"admin","guard_name":"web","created_at":"2020-03-24 13:37:06","updated_at":"2020-03-24 17:53:13","permissions":[{"id":1,"name":"material-management","guard_name":"web","created_at":"2020-03-24 11:03:12","updated_at":"2020-03-24 11:03:12","pivot":{"role_id":17,"permission_id":1}},{"id":2,"name":"financial-management","guard_name":"web","created_at":"2020-03-24 11:03:13","updated_at":"2020-03-24 11:03:13","pivot":{"role_id":17,"permission_id":2}},{"id":4,"name":"personnel-management","guard_name":"web","created_at":"2020-03-24 11:03:15","updated_at":"2020-03-24 11:03:15","pivot":{"role_id":17,"permission_id":4}}]}}
     * @return_param id int 角色id
     * @return_param name string 角色名
     * @return_param guard_name int 角色所属组
     * @return_param permissions.id int 权限id
     * @return_param permissions.name int 权限名称
     * @return_param permissions.guard_name int 权限所属组
     * @return_param permissions.pivot.role_id int 权限所属角色id
     * @return_param permissions.pivot.permission_id int 权限id
     * @remark 角色id即获取用户信息接口中返回的roles_id
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
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 获取当前角色权限
     * @description 获取当前角色权限的接口
     * @method `get` `query_string`
     * @url {{host}}/api/role-permission/rolehavepermisson
     * @param id 必选 string 角色id 即 获取用户信息接口中返回的 roles_id
     * @json_param 将参数以query_string方式接在url后，例如：{{host}}/api/role-permission/rolehavepermisson?id=1
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return  {"status":200,"message":"操作成功","data":[{"id":1,"name":"material-management","guard_name":"web","created_at":"2020-03-24 11:03:12","updated_at":"2020-03-24 11:03:12","name_CN":"物资管理","pivot":{"role_id":17,"permission_id":1}},{"id":2,"name":"financial-management","guard_name":"web","created_at":"2020-03-24 11:03:13","updated_at":"2020-03-24 11:03:13","name_CN":"财务管理","pivot":{"role_id":17,"permission_id":2}},{"id":4,"name":"personnel-management","guard_name":"web","created_at":"2020-03-24 11:03:15","updated_at":"2020-03-24 11:03:15","name_CN":"人事管理","pivot":{"role_id":17,"permission_id":4}}]}
     * @return_param id string 权限id
     * @return_param name string 权限名称
     * @return_param guard_name int 权限所属组
     * @return_param name_CN int 权限中文名
     * @return_param pivot.role_id int 权限所属角色id
     * @return_param pivot.permission_id int 权限id
     * @remark 角色id即获取用户信息接口中返回的roles_id
     */
    public function roleHavePermisson(Request $request,Role $role)
    {
        $role_id    = $request->all()['id'];
        $role       = $role::find($role_id);
        if ($role){
            $permisson  = $role->getAllPermissions();
            $module = config('module');
            foreach ($permisson as $key=>$value){
                $permisson[$key]['name_CN'] = $module[$value['name']];
            }
            return $this->apiReturn($permisson,CodeEnum::SUCCESS);
        }
        return $this->apiReturn('',CodeEnum::USER_NOT_EXISTENT);
    }
}
