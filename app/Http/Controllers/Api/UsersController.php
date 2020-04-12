<?php

namespace App\Http\Controllers\Api;

use App\Enum\CodeEnum;
use App\Events\ChangeUsersName;
use App\Events\Users;
use App\Events\UsersDelete;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UserRequest;
use App\Model\Image;
use App\Model\User;
use App\Traits\ApiTraits;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsersController extends Controller
{
    use ApiTraits;

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 用户注册
     * @description 用户注册的接口
     * @method `post`  `application/json`
     * @url {{host}}/api/users
     * @param username 必选 string 用户名 支持中文,英文,数字,横杆和下划线
     * @param password 必选 string 密码 长度最小为5
     * @json_param {"username":"admin","password":"admin"}
     * @return {"status":201,"message":"新增成功","data":{"name":"admin","updated_at":"2020-03-24 13:37:04","created_at":"2020-03-24 13:37:04","id":35}}
     * @return_param name string 注册的用户名
     * @return_param id int 注册用户的id
     */
    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->username,
            'password' => bcrypt($request->password),
        ]);
        if ($user){
            event(new Users($user));
        }
        return $this->apiReturn($user,CodeEnum::INC_SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 获取用户信息
     * @description 获取用户信息的接口
     * @method `get`
     * @url {{host}}/api/user
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return {"status":200,"message":"操作成功","data":{"id":35,"roles_id":17,"name":"admin","email":null,"avatar":"http://59.110.212.116:32801/uploads/images/avatars/202004/06/35_1586153168_1kKRgZbUYK.jpeg","created_at":"2020-03-24 13:37:04","updated_at":"2020-04-06 14:07:24","mate":{"access_token":"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC81OS4xMTAuMjEyLjExNjozMjgwMVwvYXBpXC91c2VyIiwiaWF0IjoxNTg2MTUzMjUyLCJleHAiOjE1ODYxNTY4NTIsIm5iZiI6MTU4NjE1MzI1MiwianRpIjoiOFgxVmVnTE40YzU3UUZjYiIsInN1YiI6MzUsInBydiI6ImY2YjcxNTQ5ZGI4YzJjNDJiNzU4MjdhYTQ0ZjAyYjdlZTUyOWQyNGQifQ.y2Xo2DJjV6dwIy09uwDoySnfn1Dixxt6pIEFFFOxdwE","token_type":"Bearer","expires_in":3600},"permission":[{"id":1,"name":"material-management","guard_name":"web","created_at":"2020-03-24 11:03:12","updated_at":"2020-03-24 11:03:12","name_CN":"物资管理","pivot":{"role_id":12,"permission_id":1}},{"id":2,"name":"financial-management","guard_name":"web","created_at":"2020-03-24 11:03:13","updated_at":"2020-03-24 11:03:13","name_CN":"财务管理","pivot":{"role_id":12,"permission_id":2}},{"id":4,"name":"personnel-management","guard_name":"web","created_at":"2020-03-24 11:03:15","updated_at":"2020-03-24 11:03:15","name_CN":"人事管理","pivot":{"role_id":12,"permission_id":4}}]}}
     * @return_param id int 用户的id
     * @return_param name string 用户名
     * @return_param email string 邮箱
     * @return_param avatar string 用户头像地址
     * @return_param mate.access_token string token
     * @return_param mate.token_type string token类型
     * @return_param mate.expires_in int token时效(单位：秒)
     * @return_param permission.id int 权限id
     * @return_param permission.name string 权限英文名
     * @return_param permission.guard_name string 所属权限组
     * @return_param permission.name_CN string 权限中文名，仅用于显示
     * @return_param permission.pivot.role_id string 角色id
     * @return_param permission.pivot.permission_id string 权限id
     * @remark 本系统采用 用户扮演角色的形式，通过给角色赋予权限来给用户以权限
     */
    public function me()
    {
        // 获取当前登陆用户信息
        $user   = \Auth::guard('api')->user();
        // 获取当前用户所有权限
        $role = new Role();
        $role       = $role::find($user['roles_id']);
        $models_permission  = $role->getAllPermissions();
        foreach ($models_permission as $key=>$value) {
            $models_permission[$key]['name_CN'] = config("module.".$value['name']);
        }
        $user->mate = [
            'access_token' => \Auth::guard('api')->fromUser(\Auth::guard('api')->user()),
            'token_type' => 'Bearer',
            'expires_in' => \Auth::guard('api')->factory()->getTTL() * 60
        ];
        $user->permission = $models_permission;
        unset($user['permissions'],$user['roles']);
        return $this->apiReturn($user,CodeEnum::SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 修改用户信息
     * @description 修改用户信息的接口
     * @method `patch`  `application/json`
     * @url {{host}}/api/user
     * @param name 必选 string 用户名 支持中文,英文,数字,横杆和下划线
     * @param avatar_image_id 必选 string 头像id
     * @json_param {"name":"admin","avatar_image_id":6}
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return {"status":200,"message":"操作成功","data":{"id":26,"roles_id":12,"name":"admin","email":null,"avatar":"http://59.110.212.116:32801/uploads/images/avatars/202003/24/26_1585036865_9XM0Sc19ZN.jpg","created_at":"2020-03-24 12:52:33","updated_at":"2020-03-24 16:52:50"}}
     * @return_param id int 用户的id
     * @return_param name string 用户名
     * @return_param email string 邮箱
     * @return_param avatar string 用户头像地址
     * @remark avatar_image_id 为调用图片上传接口上传图片后返回的图片主键id
     */
    public function update(UserRequest $request)
    {
        $user = \Auth::guard('api')->user();

        $attributes = $request->only(['name']);

        if ($request->avatar_image_id) {
            $image = Image::find($request->avatar_image_id);

            $attributes['avatar'] = $image->path;
        }

        $result = $user->update($attributes);
        if ($result){
            event(new ChangeUsersName($user));
        }

        return $this->apiReturn($user,CodeEnum::SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 用户删除
     * @description 删除用户息的接口
     * @method `delete`  `application/json`
     * @url {{host}}/api/user
     * @param username 必选 string 用户名
     * @json_param {"username":"admin"}
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return {"status":204,"message":"删除成功","data":""}
     */
    public function delete(UserRequest $request)
    {
        $name = $request->username;
        $is_delete = User::query()->where(['name'=>$name])->delete();
        if ($is_delete){
            event(new UsersDelete($name));
        }
        return $this->apiReturn('',CodeEnum::DELETE_SUCCESS);
    }

    /**
     * showdoc
     * @catalog 接口文档/用户认证&权限管理
     * @title 修改用户密码
     * @description 修改用户信息的接口
     * @method `post`  `application/json`
     * @url {{host}}/api/user/password
     * @param username 必选 string 用户名
     * @param password 必选 string 密码
     * @json_param {"name":"admin","password":"admin"}
     * @header Authorization 必选  string 应用认证token(Bearer类型)
     * @return {"status":200,"message":"操作成功","data":{"id":26,"roles_id":12,"name":"admin","email":null,"avatar":"http://59.110.212.116:32801/uploads/images/avatars/202003/24/26_1585036865_9XM0Sc19ZN.jpg","created_at":"2020-03-24 12:52:33","updated_at":"2020-03-24 16:52:50"}}
     * @return_param id int 用户的id
     * @return_param name string 用户名
     * @return_param email string 邮箱
     * @return_param avatar string 用户头像地址
     */
    public function changePassword(UserRequest $request)
    {
        $user = User::query()->updateOrCreate(['name' => $request->username],['password' => bcrypt($request->password)]);
        if ($user){
            return $this->apiReturn($user,CodeEnum::SUCCESS);
        }
        return $this->apiReturn('',CodeEnum::FAIL);
    }
}
