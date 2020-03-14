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
    //人事管理
    $api->group(["prefix" => "personnel-manage"], function ($api) {
        //部门管理
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
        //员工管理
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
        //岗位管理
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

        //团队管理
        $api->group(["prefix" => "team-manage"], function ($api) {
            // 新增或编辑团队数据
            $api->post('/', 'PersonnelManage\TeamManageController@store')->name('api.team-manage.store');

            // 团队数据详情
            $api->get('/{id}', 'PersonnelManage\TeamManageController@detail')
                ->where(['id' => '\d+']);

            // 团队数据删除
            $api->delete('/{id}', 'PersonnelManage\TeamManageController@delete')
                ->where(['id' => '\d+']);

            // 团队数据批量删除
            $api->delete('/', 'PersonnelManage\TeamManageController@batchDelete');

            // 团队数据列表
            $api->get('/list', 'PersonnelManage\TeamManageController@list');
        });

    });

    //膳食管理
    $api->group(["prefix" => "diet-manage"], function ($api) {
        //单品管理
        $api->group(["prefix" => "food-manage"], function ($api) {

            // 新增或编辑单品数据
            $api->post('/', 'DietManage\FoodManageController@store')->name('api.food-manage.store');

            // 单品数据详情
            $api->get('/{id}', 'DietManage\FoodManageController@detail')
                ->where(['id' => '\d+']);

            // 单品数据删除
            $api->delete('/{id}', 'DietManage\FoodManageController@delete')
                ->where(['id' => '\d+']);

            // 单品数据批量删除
            $api->delete('/', 'DietManage\FoodManageController@batchDelete');

            // 单品数据列表
            $api->get('/list', 'DietManage\FoodManageController@list');

            // 单品状态更改
            $api->get('/change-type/{id}', 'DietManage\FoodManageController@typeChange')
                ->where(['id' => '\d+']);

        });
        //套餐管理
        $api->group(["prefix" => "package-manage"], function ($api) {

            // 新增或编辑套餐数据
            $api->post('/', 'DietManage\PackageManageController@store')->name('api.package-manage.store');

            // 套餐数据详情
            $api->get('/{id}', 'DietManage\PackageManageController@detail')
                ->where(['id' => '\d+']);

            // 套餐数据删除
            $api->delete('/{id}', 'DietManage\PackageManageController@delete')
                ->where(['id' => '\d+']);

            // 套餐数据批量删除
            $api->delete('/', 'DietManage\PackageManageController@batchDelete');

            // 单品数据列表
            $api->get('/list', 'DietManage\PackageManageController@list');

            // 预定套餐
            $api->get('/order/{id}', 'DietManage\PackageManageController@order')
                ->where(['id' => '\d+']);

        });
    });
    $api->group(["prefix" => "member-manage"], function ($api) {
        // 会员档案路由注册
        $api->group(["prefix" => "member-profile"], function ($api) {
            //新增会员
            $api->post('/', 'MemberManagement\MemberProfileController@store')->name('api.member-manage.member-profile.store');

            //会员信息修改
            $api->post('/{id}', 'MemberManagement\MemberProfileController@store')->name('api.member-manage.member-profile.store')->where(['id' => '\d+']);

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
            $api->post('/', 'MemberManagement\BookBedController@store')->name('api.member-manage.book-bed.store');

            //预约订单信息修改
            $api->post('/{id}', 'MemberManagement\BookBedController@store')->name('api.member-manage.book-bed.store')->where(['id' => '\d+']);

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

            // 入住登记修改
            $api->post('/change', 'MemberManagement\CheckInManageController@change');

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

        // 退住登记
        $api->group(["prefix" => "check-out"], function ($api){
            $api->post('/', 'MemberManagement\CheckOutController@store')->name('api.member-manage.check-out.store');

            //退住登记详情
            $api->get('/{id}', 'MemberManagement\CheckOutController@detail')->where(['id' => '\d+']);

            //退住登记删除
            $api->delete('/{id}', 'MemberManagement\CheckOutController@delete')->where(['id' => '\d+']);

            //退住登记列表
            $api->get('/list', 'MemberManagement\CheckOutController@list');

            //退住登记搜索
            $api->get('/search', 'MemberManagement\CheckOutController@search');

            //退住登记批量删除
            $api->delete('/', 'MemberManagement\CheckOutController@batchDelete');

        });

        // 外出管理
        $api->group(["prefix" => "out-manage"], function ($api){
            $api->post('/', 'MemberManagement\OutManageController@store')->name('api.member-manage.out-manage.store');

            //退住登记详情
            $api->get('/{id}', 'MemberManagement\OutManageController@detail')->where(['id' => '\d+']);

            //退住登记删除
            $api->delete('/{id}', 'MemberManagement\OutManageController@delete')->where(['id' => '\d+']);

            //退住登记列表
            $api->get('/list', 'MemberManagement\OutManageController@list');

            //退住登记搜索
            $api->get('/search', 'MemberManagement\OutManageController@search');

            //退住登记批量删除
            $api->delete('/', 'MemberManagement\OutManageController@batchDelete');

        });

        // 死亡登记
        $api->group(["prefix" => "death-registration"], function ($api){
            $api->post('/', 'MemberManagement\DeathRegistrationController@store')->name('api.member-manage.death-registration.store');

            $api->get('/{id}', 'MemberManagement\DeathRegistrationController@detail')->where(['id' => '\d+']);

            $api->delete('/{id}', 'MemberManagement\DeathRegistrationController@delete')->where(['id' => '\d+']);

            $api->get('/list', 'MemberManagement\DeathRegistrationController@list');

            $api->get('/search', 'MemberManagement\DeathRegistrationController@search');

            $api->delete('/', 'MemberManagement\DeathRegistrationController@batchDelete');

        });
    });
});
