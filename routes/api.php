<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){
    $api->get('credit_management/show', 'App\Http\Controllers\CreditManagementController@show');
    $api->get('credit_management/showWithType/{type}','App\Http\Controllers\CreditManagementController@showWithType');
    $api->get('credit_management/showWithVoucherNo/{voucherNo}','App\Http\Controllers\CreditManagementController@showWithVoucherNo');
});
