<<<<<<< HEAD
    <?php
=======
<?php
>>>>>>> ac41b103b8309f213dff1f7c72a890c19243358f

use Dingo\Api\Routing\Router;

/**
<<<<<<< HEAD
 * @var Dingo\Api\Routing\Router
=======
 * @var $api Dingo\Api\Routing\Router
>>>>>>> ac41b103b8309f213dff1f7c72a890c19243358f
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
<<<<<<< HEAD
    'prefix'     => 'api',
    'namespace'  => 'App\Http\Controllers\Api',
], function (Router $api) {
    $api->group(['prefix' => 'credit-management'], function ($api) {
        // 收款账单查询
        $api->get('/', 'CreditManagement\CreditManagementController@show');

        //收款账单按付款类型查询
        $api->get('/Type/{type}', 'CreditManagement\CreditManagementController@showWithType');

        //收款账单按账单号查询
        $api->get('/VoucherNo/{voucherNo}', 'CreditManagement\CreditManagementController@showWithVoucherNo');

        //收款账单按是否已经缴费分类查询
        $api->get('/IfPay/{ifPay}', 'CreditManagement\CreditManagementController@showWithIfPay');

        $api->post('/', 'CreditManagement\CreditManagementController@store');

        $api->delete('/{voucherNo}', 'CreditManagement\CreditManagementController@destory');

        $api->patch('/', 'CreditManagement\CreditManagementController@update');
    });
});
=======
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
>>>>>>> ac41b103b8309f213dff1f7c72a890c19243358f
