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
    $api->group(["prefix" => "fixed-assets"], function ($api) {
        // 固定资产数据存储
        $api->post('/', 'FixedAssets\FixedAssetsController@store')->name('api.fixed-assets.store');

        // 固定资产数据详情
        $api->get('/{id}', 'FixedAssets\FixedAssetsController@detail')
            ->where(['id' => '\d+']);

        // 固定资产数据删除
        $api->delete('/{id}', 'FixedAssets\FixedAssetsController@delete')
            ->where(['id' => '\d+']);

        // 固定资产数据批量删除
        $api->delete('/', 'FixedAssets\FixedAssetsController@batchDelete');

        // 固定资产数据列表
        $api->get('/list', 'FixedAssets\FixedAssetsController@list');
    });
    $api->group(["prefix" => "personnel-manage"], function ($api) {
        $api->group(["prefix" => "department-manage"], function ($api) {

            // 新增或编辑部门数据
            $api->post('/', 'PersonnelManage\DepartmentManageController@store')->name('api.department-manage.store');

            // 部门数据详情
            $api->get('/{id}', 'PersonnelManage\DepartmentManageController@detail')
                ->where(['id' => '\d+']);

            // 部门数据删除
            $api->delete('/{id}', 'PersonnelManage\DepartmentManageController@delete')
                ->where(['id' => '\d+']);

            // 部门数据批量删除
            $api->delete('/', 'PersonnelManage\DepartmentManageController@batchDelete');

            // 部门数据列表
            $api->get('/list', 'PersonnelManage\DepartmentManageController@list');

        });
        $api->group(["prefix" => "position-manage"], function ($api) {

            // 新增或编辑岗位数据
            $api->post('/', 'PersonnelManage\PositionManageController@store')->name('api.position-manage.store');

            // 岗位数据详情
            $api->get('/{id}', 'PersonnelManage\PositionManageController@detail')
                ->where(['id' => '\d+']);

            // 岗位数据删除
            $api->delete('/{id}', 'PersonnelManage\PositionManageController@delete')
                ->where(['id' => '\d+']);

            // 岗位数据批量删除
            $api->delete('/', 'PersonnelManage\PositionManageController@batchDelete');

            // 岗位数据列表
            $api->get('/list', 'PersonnelManage\PositionManageController@list');

        });
        $api->group(["prefix" => "staff-manage"], function ($api) {

            // 新增或编辑员工数据
            $api->post('/', 'PersonnelManage\StaffManageController@store')->name('api.staff-manage.store');

            // 员工数据详情
            $api->get('/{id}', 'PersonnelManage\StaffManageController@detail')
                ->where(['id' => '\d+']);

            // 员工数据删除
            $api->delete('/{id}', 'PersonnelManage\StaffManageController@delete')
                ->where(['id' => '\d+']);

            // 员工数据批量删除
            $api->delete('/', 'PersonnelManage\StaffManageController@batchDelete');

            // 员工数据列表
            $api->get('/list', 'PersonnelManage\StaffManageController@list');

        });
    });
});