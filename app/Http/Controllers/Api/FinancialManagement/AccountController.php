<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 11:52:03 AM
 */

namespace App\Http\Controllers\Api\FinancialManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FinancialManagement\AccountRequest;
use App\Http\Service\FinancialManagement\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/会员账户
         * @title 增加账户
         * @description 增加账户
         * @method `POST` `application/json`
         * @url {{host}}/api/financial-management/account
         * @param account_number true char 账户编号
         * @param member_number    是    char   会员编号 
         * @param member_name      是    char   会员姓名 
         * @param beds             是    char   床位     
         * @param account_balance  是    float  账户余额 
         * @param beds_cost        是    float  床位费   
         * @param meal_cost        是    float  膳食费   
         * @param nursing_cost     是    float  护理费   
         * @param other_cost       是    float  其他费用 
         * @param cd_card          是    float  身份证   
         * @param deposit          否    float  押金     
         * @json_param { "account_number": "A5653591", "member_number": "1196", "member_name": "来淑英", "beds": "3号楼-2-717-768", "account_balance": "6423.63", "beds_cost": "419.61", "meal_cost": "679.22", "nursing_cost": "25.65", "other_cost": "463.22", "cd_card": "492822069600925021", "deposit": "835.90" }
         * @return { "status": 200, "message": "操作成功", "data": { "account_number": "A5653591" } }
         * @return_param account_number string 账户编号
         * @remark 备注
         */
    public function store(AccountRequest $request)
    {
        $account = $request->post();

        return $this->accountService->store($account);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/会员账户
         * @title 删除账户
         * @description 删除账户
         * @method DELETE  application/json
         * @url {{host}}/api/financial-management/account
         * @param no        是    char  账户编号 
         * @json_param {host}/api/financial-management/account/A5653591
         * @return { "status": 200, "message": "操作成功", "data": { "id": "A5653591" } }
         * @return_param id string 账户编号
         * @remark 备注
         */
    public function destory($id)
    {
        return $this->accountService->destory($id);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/会员账户
         * @title 更新账户
         * @description 更新账户
         * @method update  application/json
         * @url {{host}}/api/financial-management/account
         * @param account_number   否    char   账户编号 
         * @param member_number    否    char   会员编号 
         * @param member_name      否    char   会员姓名 
         * @param beds             否    cahr   床位     
         * @param account_balance  否    float  账户余额 
         * @param beds_cost        否    float  床位费   
         * @param meal_cost        否    float  膳食费   
         * @param nursing_cost     否    float  护理费   
         * @param other_cost       否    float  其他费用 
         * @param cd_card          否    float  身份证   
         * @param deposit          否    float  押金     
         * @json_param { "account_number": "A5653591", "member_number": "1196", "member_name": "张三", "beds": "3号楼-2-717-768", "account_balance": "6423.63", "beds_cost": "419.61", "meal_cost": "679.22", "nursing_cost": "25.65", "other_cost": "463.22", "cd_card": "492822069600925021", "deposit": "835.90" }
         * @return { "status": 200, "message": "操作成功", "data": { "account_number": "A5653591" } }
         * @return_param account_number string 账户编号
         * @remark 备注
         */
    public function update(AccountRequest $request)
    {
        $account = $request->all();

        return $this->accountService->update($account);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/会员账户
         * @title 查询所有账户
         * @description 查询所有账户
         * @method GET  application/json
         * @url {{host}}/api/financial-management/account
         * @param 变量名 true 类型 变量说明
         * @param page       否    int   当前页数，默认：1          
         * @param page_size  否    int   页面含数据量大小，默认：15 
         * @param no         否    char  账户编号                   
         * @json_param `{host}/api/financial-management/account/?page=2&page_size=1`
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 2, "data": [ { "id": 2, "created_at": "1988-10-02 09:59:56", "updated_at": "1988-10-02 09:59:56", "account_number": "A5653591", "member_number": "1196", "member_name": "来淑英", "beds": "3号楼-2-717-768", "account_balance": "6423.63", "beds_cost": "419.61", "meal_cost": "679.22", "nursing_cost": "25.65", "other_cost": "463.22", "cd_card": "492822069600925021", "deposit": "835.90" } ], "first_page_url": "http://yl.test/api/financial-management/account?page=1", "from": 2, "last_page": 20, "last_page_url": "http://yl.test/api/financial-management/account?page=20", "next_page_url": "http://yl.test/api/financial-management/account?page=3", "path": "http://yl.test/api/financial-management/account", "per_page": "1", "prev_page_url": "http://yl.test/api/financial-management/account?page=1", "to": 2, "total": 20 } }
         * @return_param account_number    char   账户编号 
         * @return_param member_number     char   会员编号 
         * @return_param member_name       char   会员姓名 
         * @return_param beds              cahr   床位     
         * @return_param account_balance   float  账户余额 
         * @return_param beds_cost         float  床位费   
         * @return_param meal_cost         float  膳食费   
         * @return_param nursing_cost      float  护理费   
         * @return_param other_cost        float  其他费用 
         * @return_param cd_card           float  身份证   
         * @return_param deposit           float  押金     
         * @remark 备注
         */
    public function show(Request $request)
    {
        if ($request->filled('no')) {
            return $this->accountService->showWithNo($request->get('no'), $request->get('page', 1), $request->get('page_size', 15));
        }

        return $this->accountService->show($request->get('page', 1), $request->get('page_size', 15));
    }

    public function showDeposit(Request $request)
    {
        return $this->accountService
                  ->showDeposit($request->get('member_name', 'null'), $request->get('page', 1), $request->get('page_size', 15));
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/会员账户
         * @title 余额更新
         * @description 余额
         * @method PATCH  application/json
         * @url {{host}}/api/financial-management/account/balance
         * @param id true int 用户id
         * @param money true int 钱，减少用负数
         * @json_param yl.test/api/financial-management/account/balance?id=1&money=12
         * @return { "status": 200, "message": "操作成功", "data": { "id": "1" } }
         * @return_param id int 用户id
         * @remark 备注
         */
    public function updateBalance(AccountRequest $request)
    {
        return $this->accountService
                    ->updateBalance($request->input('id'), $request->input('money'));
    }
}
