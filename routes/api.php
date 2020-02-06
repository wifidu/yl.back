
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

    $api->group(["prefix" => "financial-management"], function ($api) {
        // 收款账单查询
        $api->get('/', 'FinancialManagement\CreditManagementController@show');

        //收款账单按付款类型查询
        $api->get('/Type/{type}', 'FinancialManagement\CreditManagementController@showWithType');

        //收款账单按账单号查询
        $api->get('/VoucherNo/{voucherNo}', 'FinancialManagement\CreditManagementController@showWithVoucherNo');

        //收款账单按是否已经缴费分类查询
        $api->get('/IfPay/{ifPay}', 'FinancialManagement\CreditManagementController@showWithIfPay');

        $api->post('/', 'FinancialManagement\CreditManagementController@store');

        $api->delete('/{voucherNo}', 'FinancialManagement\CreditManagementController@destory');

        $api->patch('/', 'FinancialManagement\CreditManagementController@update');
    });
    $api->group(["prefix" => "department-manage"], function ($api) {

        // 新增或编辑部门数据
        $api->post('/', 'PersonnalManage\DepartmentManageController@store')->name('api.department-manage.store');

        // 部门数据详情
        $api->get('/{id}', 'PersonnalManage\DepartmentManageController@detail')
            ->where(['id' => '\d+']);

        // 部门数据删除
        $api->delete('/{id}', 'PersonnalManage\DepartmentManageController@delete')
            ->where(['id' => '\d+']);

        // 部门数据批量删除
        $api->delete('/', 'PersonnalManage\DepartmentManageController@batchDelete');

        // 部门数据列表
        $api->get('/list', 'PersonnalManage\DepartmentManageController@list');

    });
});