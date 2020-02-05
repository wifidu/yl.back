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

    $api->group(["prefix" => "financial_management"], function ($api) {
        $api->get('credit_management/show', 'FinancialManagement\CreditManagementController@show');
        $api->get('credit_management/showWithType/{type}','FinancialManagement\CreditManagementController@showWithType');
        $api->get('credit_management/showWithVoucherNo/{voucherNo}','FinancialManagement\CreditManagementController@showWithVoucherNo');
        $api->get('credit_management/showWithIfPay/{ifPay}','FinancialManagement\CreditManagementController@showWithIfPay');
    });
});
