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

    // 会员档案路由注册
    $api->group(["prefix" => "member-profile"], function ($api) {
        //新增会员
        $api->post('/', 'MemberProfile\MemberProfileController@store')->name('api.member-profile.store');

        //会员信息修改
        $api->post('/{id}', 'MemberProfile\MemberProfileController@store')->name('api.member-profile.store')->where(['id' => '\d+']);

        //会员详情
        $api->get('/{id}', 'MemberProfile\MemberProfileController@detail')->where(['id' => '\d+']);

        //会员删除
        $api->delete('/{id}', 'MemberProfile\MemberProfileController@delete')->where(['id' => '\d+']);

        //会员列表
        $api->get('/list', 'MemberProfile\MemberProfileController@list');

        //会员搜索
        $api->get('/search', 'MemberProfile\MemberProfileController@search');
    });

});