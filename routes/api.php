    <?php

use Dingo\Api\Routing\Router;

/**
 * @var Dingo\Api\Routing\Router
 */
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', [
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
    });
});
