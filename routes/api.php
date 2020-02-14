
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
    $api->group(['prefix' => "material-management"], function ($api) {
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
    $api->group(["prefix" => "financial-management"], function ($api) {
        $api->group(["prefix" => "credit-management"], function ($api) {
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

        // 收款账单
        $api->group(["prefix" => "refund"], function ($api){
          $api->get('/', 'FinancialManagement\RefundController@show');

          $api->get('/no/{no}', 'FinancialManagement\RefundController@showWithNo');

          $api->get('/status/{status}', 'FinancialManagement\RefundController@showWithStatus');

          $api->get('/type/{type}', 'FinancialManagement\RefundController@showWithType');

          $api->post('/', 'FinancialManagement\RefundController@store');

          $api->patch('/', 'FinancialManagement\RefundController@update');

          $api->delete('/{no}', 'FinancialManagement\RefundController@destory');
        });
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

        $api->group(["prefix" => "member-manage"], function ($api) {
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

            // 预约占床
            $api->group(["prefix" => "book-bed"], function ($api) {
                //新增预约订单
                $api->post('/', 'MemberManagement\BookBedController@store')->name('api.member-profile.store');

                //预约订单信息修改
                $api->post('/{id}', 'MemberManagement\BookBedController@store')->name('api.member-profile.store')->where(['id' => '\d+']);

                //预约订单详情
                $api->get('/{id}', 'MemberManagement\BookBedController@detail')->where(['id' => '\d+']);

                //预约订单取消
                $api->delete('/{id}', 'MemberManagement\BookBedController@cancel')->where(['id' => '\d+']);

                //预约订单列表
                $api->get('/list', 'MemberManagement\BookBedController@list');

                //预约订单搜索
                $api->get('/search', 'MemberManagement\BookBedController@search');

                //预约订单批量删除
                $api->delete('/', 'MemberManagement\BookBedController@batchDelete');
            });
    });
});
