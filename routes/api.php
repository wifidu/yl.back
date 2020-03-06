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
        });
    });

    $api->group([
        'prefix' => "material-management"],function ($api) {
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
            $api->delete('/', 'MaterialManagement\FixedAssetsController@batchDelete')->name('api.fixed-assets.delete');

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
            $api->delete('/', 'MaterialManagement\MaterialController@batchDelete')->name('api.material.delete');

            // 物资数据列表
            $api->get('/list', 'MaterialManagement\MaterialController@list');
        });
        $api->group(["prefix" => "material-in"], function ($api) {
            // 物资入库数据存储
            $api->post('/', 'MaterialManagement\MaterialInController@store')->name('api.material.in.store');

            // 物资入库数据详情
            $api->get('/{id}', 'MaterialManagement\MaterialInController@detail')
                ->where(['id' => '\d+']);

            // 物资入库数据删除
            $api->delete('/{id}', 'MaterialManagement\MaterialInController@delete')
                ->where(['id' => '\d+']);

            // 物资入库数据批量删除
            $api->delete('/', 'MaterialManagement\MaterialInController@batchDelete')->name('api.material.in.delete');

            // 物资入库数据列表
            $api->get('/list', 'MaterialManagement\MaterialInController@list');

            // 物资入库单号获取
            $api->get('/odd_number','MaterialManagement\MaterialInController@RKoddNumber');
        });
        $api->group(["prefix" => "material-out"], function ($api) {
            // 物资出库数据存储
            $api->post('/', 'MaterialManagement\MaterialOutController@store')->name('api.material.out.store');

            // 物资出库数据详情
            $api->get('/{id}', 'MaterialManagement\MaterialOutController@detail')
                ->where(['id' => '\d+']);

            // 物资出库数据删除
            $api->delete('/{id}', 'MaterialManagement\MaterialOutController@delete')
                ->where(['id' => '\d+']);

            // 物资出库数据批量删除
            $api->delete('/', 'MaterialManagement\MaterialOutController@batchDelete')->name('api.material.out.delete');

            // 物资出库数据列表
            $api->get('/list', 'MaterialManagement\MaterialOutController@list');

            // 物资出库单号获取
            $api->get('/odd_number','MaterialManagement\MaterialOutController@CKoddNumber');
        });
        $api->group(["prefix" => "inventory-management"], function ($api) {
            // 生成上个月盘点数据
            $api->post('/generate', 'MaterialManagement\InventoryManagementController@generate');

            // 盘点管理-盘点
            $api->post('/', 'MaterialManagement\InventoryManagementController@store')->name('api.inventory.store');

            // 盘点管理-数据详情
            $api->get('/{id}', 'MaterialManagement\InventoryManagementController@detail')
                ->where(['id' => '\d+']);

            // 盘点管理-盘点详情
            $api->get('/inventoryDetail/{id}', 'MaterialManagement\InventoryManagementController@inventoryDetail')
                ->where(['id' => '\d+']);

            // 盘点管理-搜索
            $api->post('/search', 'MaterialManagement\InventoryManagementController@search');

            // 盘点管理数据删除
            $api->delete('/{id}', 'MaterialManagement\InventoryManagementController@delete')
                ->where(['id' => '\d+']);

            // 盘点管理数据批量删除
            $api->delete('/', 'MaterialManagement\InventoryManagementController@batchDelete')->name('api.inventory.management.delete');

            // 盘点管理数据列表
            $api->get('/list', 'MaterialManagement\InventoryManagementController@list');
        });
        $api->group(["prefix" => "warehouse-log"], function ($api) {
            // 仓库日志-数据详情
            $api->get('/{id}', 'MaterialManagement\WareHouseLogController@detail')
                ->where(['id' => '\d+']);

            // 仓库日志-搜索
            $api->post('/search', 'MaterialManagement\WareHouseLogController@search');

            // 仓库日志数据删除
            $api->delete('/{id}', 'MaterialManagement\WareHouseLogController@delete')
                ->where(['id' => '\d+']);

            // 仓库日志数据批量删除
            $api->delete('/', 'MaterialManagement\WareHouseLogController@batchDelete')->name('api.warehouse.log.delete');

            // 仓库日志数据列表
            $api->get('/list', 'MaterialManagement\WareHouseLogController@list');

            // 导出仓库日志
            $api->get('/execl','MaterialManagement\WareHouseLogController@excelExport');
        });
    });
});