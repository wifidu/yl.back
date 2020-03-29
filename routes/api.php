<?php

use Dingo\Api\Routing\Router;

/**
 * @var $api Dingo\Api\Routing\Router
 */
$api = app('Dingo\Api\Routing\Router');


$api->version('v1', [
    "prefix" => "api",
    'namespace' => 'App\Http\Controllers\Api',
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

    $api->group(['prefix' => "material-management"],function ($api) {
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
        });

    });
    $api->group(["prefix" => "financial-management"], function ($api) {
        $api->group(["prefix" => "collection"], function ($api) {
            // 收款账单查询
            $api->get('/', 'FinancialManagement\CreditManagementController@show');

            //收款账单按付款类型查询
            $api->get('/type/{type}', 'FinancialManagement\CreditManagementController@showWithType');

            //收款账单按账单号查询
            $api->get('/no/{voucherNo}', 'FinancialManagement\CreditManagementController@showWithVoucherNo');

            //收款账单按是否已经缴费分类查询
            $api->get('/IfPay/{ifPay}', 'FinancialManagement\CreditManagementController@showWithIfPay');

            $api->post('/', 'FinancialManagement\CreditManagementController@store');

            $api->delete('/{voucherNo}', 'FinancialManagement\CreditManagementController@destory');

            $api->patch('/', 'FinancialManagement\CreditManagementController@update');
        });

        // 退款账单
        $api->group(["prefix" => "refund"], function ($api) {
            $api->get('/', 'FinancialManagement\RefundController@show');
            $api->post('/', 'FinancialManagement\RefundController@store');
            $api->patch('/', 'FinancialManagement\RefundController@update');
            $api->delete('/{no}', 'FinancialManagement\RefundController@destory');
        });

        // 会员账户
        $api->group(["prefix" => "account"], function ($api) {
            $api->get('/', 'FinancialManagement\AccountController@show');
            $api->get('/deposit', 'FinancialManagement\AccountController@showDeposit');
            $api->post('/', 'FinancialManagement\AccountController@store');
            $api->patch('/', 'FinancialManagement\AccountController@update');
            $api->patch('/balance', 'FinancialManagement\AccountController@updateBalance');
            $api->delete('/{no}', 'FinancialManagement\AccountController@destory');
        });
        // 机构账户
        $api->group(["prefix" => "agency"], function ($api){
            $api->get('/', 'FinancialManagement\AgencyController@show');
            $api->post('/', 'FinancialManagement\AgencyController@store');
            $api->patch('/', 'FinancialManagement\AgencyController@update');
            $api->delete('/{business_number}', 'FinancialManagement\AgencyController@destory');
        });
    });
    $api->group(["prefix" => "daily-management"], function ($api) {
        $api->group(["prefix" => "accident"], function ($api) {
            $api->get('/', 'DailyManagement\AccidentController@show');
            $api->post('/', 'DailyManagement\AccidentController@store');
            $api->patch('/', 'DailyManagement\AccidentController@update');
            $api->delete('/{id}', 'DailyManagement\AccidentController@destory');
        });

        $api->group(["prefix" => "visit"], function ($api) {
            $api->get('/', 'DailyManagement\VisitController@show');
            $api->post('/', 'DailyManagement\VisitController@store');
            $api->patch('/', 'DailyManagement\VisitController@update');
            $api->delete('/{id}', 'DailyManagement\VisitController@destroy');
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

    });
    $api->group(["prefix" => "member-manage"], function ($api) {
        // 会员档案路由注册
        $api->group(["prefix" => "member-profile"], function ($api) {
            //新增会员
            $api->post('/', 'MemberManagement\MemberProfileController@store')->name('api.member-profile.store');

            //会员信息修改
            $api->post('/{id}', 'MemberManagement\MemberProfileController@store')->name('api.member-profile.store')->where(['id' => '\d+']);

            //会员详情
            $api->get('/{id}', 'MemberManagement\MemberProfileController@detail')->where(['id' => '\d+']);

            //会员删除
            $api->delete('/{id}', 'MemberManagement\MemberProfileController@delete')->where(['id' => '\d+']);

            //会员列表
            $api->get('/list', 'MemberManagement\MemberProfileController@list');

            //会员搜索
            $api->get('/search', 'MemberManagement\MemberProfileController@search');
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

        // 入住登记
        $api->group(["prefix" => "check-in"], function ($api){
            $api->post('/', 'MemberManagement\CheckInManageController@store')->name('api.member-manage.check-in.store');

            $api->post('/upload', 'MemberManagement\CheckInManageController@upload');

            //入住登记详情
            $api->get('/{id}', 'MemberManagement\CheckInManageController@detail')->where(['id' => '\d+']);

            //入住登记删除
            $api->delete('/{id}', 'MemberManagement\CheckInManageController@delete')->where(['id' => '\d+']);

            //入住登记列表
            $api->get('/list', 'MemberManagement\CheckInManageController@list');

            //入住登记搜索
            $api->get('/search', 'MemberManagement\CheckInManageController@search');

            //入住登记批量删除
            $api->delete('/', 'MemberManagement\CheckInManageController@batchDelete');

        });
    });
});
