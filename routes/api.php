<?php

use Dingo\Api\Routing\Router;

/**
 * @var $api Dingo\Api\Routing\Router
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
    "prefix"     => "api",
    'namespace'  => 'App\Http\Controllers\Api',
], function (Router $api) {

    $api->group([
//        'middleware' => 'api.throttle',
//        'limit' => config('api.rate_limits.sign.limit'),
//        'expires' => config('api.rate_limits.sign.expires'),
    ], function($api) {

        // 用户注册
        $api->post('users', 'UsersController@store')
            ->name('api.users.store');
        // 获取token
        $api->post('authorizations', 'AuthorizationsController@login')
            ->name('api.authorizations.login');
        // 需要 token 验证的接口
        $api->group(['middleware' => 'auth:api'], function($api) {
            // 当前登录用户信息
            $api->get('user', 'UsersController@me')
                ->name('api.user.show');
            // 编辑登录用户信息
            $api->patch('user', 'UsersController@update')
                ->name('api.user.update');
            // 图片资源
            $api->post('images', 'ImagesController@store')
                ->name('api.images.store');
            //角色权限
            $api->group(['prefix' => 'role-permission'], function ($api){
                // 所有权限列表
                $api->get('list','RolePermissionController@list');
                // 赋予角色权限
                $api->post('givepermisstorole','RolePermissionController@givePermissionToRole');
                // 取消角色权限
                $api->post('revokepermisstorole','RolePermissionController@revokePermissionToRole');
                // 获取当前角色权限
                $api->post('rolehavepermisson','RolePermissionController@roleHavePermisson');
                // 添加角色
                $api->post('addrole','RolePermissionController@addRole');
            });
            //用户权限
            $api->group(['prefix' => 'model-permission'], function ($api){
                $api->get('modelhavepermisson','ModelPermissionController@modelHavePermisson');
            });
        });
    });

    $api->group([
        'prefix' => "material-management", 'middleware' => 'permission'],function ($api) {
        $api->group(["prefix" => "fixed-assets"], function ($api) {
            // 固定资产数据存储
            $api->post('/', 'MaterialManagement\FixedAssetsController@store')->name('api.fixed-assets.store');

            // 固定资产数据详情
            $api->get('/{id}', 'MaterialManagement\FixedAssetsController@detail')
                ->where(['id' => '\d+']);

            // 固定资产数据删除
            $api->delete('/{id}', 'MaterialManagement\FixedAssetsController@delete')
                ->where(['id' => '\d+']);

            // 固定资产数据批量删除
            $api->delete('/', 'MaterialManagement\FixedAssetsController@batchDelete');

            // 固定资产数据列表
            $api->get('/list', 'MaterialManagement\FixedAssetsController@list');
        });
        $api->group(["prefix" => "material"], function ($api) {
            // 物资数据存储
            $api->post('/', 'MaterialManagement\MaterialController@store')->name('api.material.store');

            // 物资数据详情
            $api->get('/{id}', 'MaterialManagement\MaterialController@detail')
                ->where(['id' => '\d+']);

            // 物资数据删除
            $api->delete('/{id}', 'MaterialManagement\MaterialController@delete')
                ->where(['id' => '\d+']);

            // 物资数据批量删除
            $api->delete('/', 'MaterialManagement\MaterialController@batchDelete');

            // 物资数据列表
            $api->get('/list', 'MaterialManagement\MaterialController@list');
        });


    });
});