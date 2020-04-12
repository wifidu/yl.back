<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 11:53:49 AM
 */

namespace App\Http\Controllers\Api\FinancialManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FinancialManagement\CreditManagementRequest;
use App\Http\Service\FinancialManagement\CreditManagementService;
use Illuminate\Http\Request;

class CreditManagementController extends Controller
{
    protected $creditManagementService;

    public function __construct(CreditManagementService $creditManagementService)
    {
        $this->creditManagementService = $creditManagementService;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title 查询所有账单
         * @description 查
         * @method GET  application/json
         * @url {{host}}/api/financial-management/collection
         * @param page       否    `int`  当前页数，默认1      
         * @param page_size  否    `int`  页面数据数目，默认15 
         * @json_param { "page":"1", "page_size":"15", }
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 1, "data": [ { "id": 1, "business_time": "1993-07-23 23:28:13", "voucher_no": "SK41993072399612032", "account_id": 9, "payment_type": "入住收费", "amount_receivable": "83676.00", "account_balance": "4682.01", "billing_date": "1993-07-23 23:28:13", "if_pay": "已支付", "account": { "id": 9, "created_at": "1976-12-20 08:40:54", "updated_at": "1976-12-20 08:40:54", "account_number": "A1363773", "member_number": "7777", "member_name": "桂志强", "beds": "1号楼-2-574-113", "account_balance": "1767.61", "beds_cost": "388.52", "meal_cost": "998.02", "nursing_cost": "627.72", "other_cost": "260.48", "cd_card": "323600533637433257" } } ], "first_page_url": "http://yl.test/api/financial-management/collection?page=1", "from": 1, "last_page": 20, "last_page_url": "http://yl.test/api/financial-management/collection?page=20", "next_page_url": "http://yl.test/api/financial-management/collection?page=2", "path": "http://yl.test/api/financial-management/collection", "per_page": "1", "prev_page_url": null, "to": 1, "total": 20 } }
         * @return_param business_time          char    业务时间，时间格式为：Y-m-d H:i:s      
         * @return_param voucher_no             char    收款单号                               
         * @return_param account_id             int     账户id                                 
         * @return_param payment_type           char    收费类型，0表示入住收费，1表示变更收费 
         * @return_param amount_receivable      double  应收金额，单位元，保留两位小数         
         * @return_param amount_balance         double  帐号余额，单位元，保留两位小数         
         * @return_param billing_date           char    账单日期,时间格式为：Y-m-d H:i:s       
         * @return_param if_pay                 int     是否已经收费，0未收费，1收费了         
         * @remark 备注
         */
    public function show(Request $request)
    {
        $page      = $request->page      ?? 1;
        $page_size = $request->page_size ?? 15;
        $results   = $this->creditManagementService->show($page, $page_size);

        return $results;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title 根据类型查询账单
         * @description 根据类型查询账单
         * @method GET  application/json
         * @url {{host}}/api/financial-management/type/{type}
         * @param type true int 0表示入住收费，1表示变更收费
         * @param page       否    `int`  当前页数，默认1      
         * @param page_size  否    `int`  页面数据数目，默认15 
         * @json_param `{host}/api/financial-management/collection/0`
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 2, "data": [ { "id": 2, "business_time": "1970-03-21 09:25:13", "voucher_no": "SK41970032125755279", "account_id": 11, "payment_type": "入住收费", "amount_receivable": "48663.17", "account_balance": "2935.85", "billing_date": "1970-03-21 09:25:13", "if_pay": "未支付", "account": { "id": 11, "created_at": "2015-08-21 16:46:04", "updated_at": "2015-08-21 16:46:04", "account_number": "A1437916", "member_number": "3847", "member_name": "柴华", "beds": "6号楼-6-112-422", "account_balance": "4756.41", "beds_cost": "566.78", "meal_cost": "208.33", "nursing_cost": "782.02", "other_cost": "313.21", "cd_card": "348614614844405522" } } ], "first_page_url": "http://yl.test/api/financial-management/collection/type/0?page=1", "from": 2, "last_page": 9, "last_page_url": "http://yl.test/api/financial-management/collection/type/0?page=9", "next_page_url": "http://yl.test/api/financial-management/collection/type/0?page=3", "path": "http://yl.test/api/financial-management/collection/type/0", "per_page": "1", "prev_page_url": "http://yl.test/api/financial-management/collection/type/0?page=1", "to": 2, "total": 9 } }
         * @return_param business_time          char    业务时间，时间格式为：Y-m-d H:i:s      
         * @return_param voucher_no             char    收款单号                               
         * @return_param account_id             int     账户id                                 
         * @return_param payment_type           char    收费类型，0表示入住收费，1表示变更收费 
         * @return_param amount_receivable      double  应收金额，单位元，保留两位小数         
         * @return_param amount_balance         double  帐号余额，单位元，保留两位小数         
         * @return_param billing_date           char    账单日期,时间格式为：Y-m-d H:i:s       
         * @return_param if_pay                 int     是否已经收费，0未收费，1收费了         
         * @remark 备注
         */
    public function showWithType($type, Request $request)
    {
        $page      = $request->page      ?? 1;
        $page_size = $request->page_size ?? 15;
        $credits   = $this->creditManagementService->showWithType($type, $page, $page_size);

        return $credits;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title 根据收款单号返回收款单
         * @description 根据收款单号返回收款单
         * @method GET  application/json
         * @url {{host}}/api/financial-management/no/{VoucherNo}
         * @param VoucherNo true int 收款单号 
         * @param page       否    `int`  当前页数，默认1      
         * @param page_size  否    `int`  页面数据数目，默认15 
         * @json_param `{host}/api/financial-management/collection/no/SK41996040196831801`
         * @return { "status": 200, "message": "操作成功", "data": [ { "id": 2, "business_time": "1970-03-21 09:25:13", "voucher_no": "SK41970032125755279", "account_id": 11, "payment_type": "入住收费", "amount_receivable": "48663.17", "account_balance": "2935.85", "billing_date": "1970-03-21 09:25:13", "if_pay": "未支付", "account": { "id": 11, "created_at": "2015-08-21 16:46:04", "updated_at": "2015-08-21 16:46:04", "account_number": "A1437916", "member_number": "3847", "member_name": "柴华", "beds": "6号楼-6-112-422", "account_balance": "4756.41", "beds_cost": "566.78", "meal_cost": "208.33", "nursing_cost": "782.02", "other_cost": "313.21", "cd_card": "348614614844405522" } } ] }
         * @return_param business_time          char    业务时间，时间格式为：Y-m-d H:i:s      
         * @return_param voucher_no             char    收款单号                               
         * @return_param account_id             int     账户id                                 
         * @return_param payment_type           char    收费类型，0表示入住收费，1表示变更收费 
         * @return_param amount_receivable      double  应收金额，单位元，保留两位小数         
         * @return_param amount_balance         double  帐号余额，单位元，保留两位小数         
         * @return_param billing_date           char    账单日期,时间格式为：Y-m-d H:i:s       
         * @return_param if_pay                 int     是否已经收费，0未收费，1收费了         
         * @remark 备注
         */
    public function showWithVoucherNo($voucherNo)
    {
        $credit = $this->creditManagementService->showWithVoucherNo($voucherNo);

        return $credit;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title 根据是否已经收款查询
         * @description 根据是否已经收款查询
         * @method GET  application/json
         * @url {{host}}/api/financial-management/IfPay/{ifPay}
         * @param ifPay true int  是否已经收费，0未收费，1收费了
         * @param page       否    `int`  当前页数，默认1      
         * @param page_size  否    `int`  页面数据数目，默认15 
         * @json_param `{host}/api/financial-management/collection/IfPay/0`
         * @return { "status": 200, "message": "操作成功", "data": [ { "id": 2, "business_time": "1970-03-21 09:25:13", "voucher_no": "SK41970032125755279", "account_id": 11, "payment_type": "入住收费", "amount_receivable": "48663.17", "account_balance": "2935.85", "billing_date": "1970-03-21 09:25:13", "if_pay": "未支付", "account": { "id": 11, "created_at": "2015-08-21 16:46:04", "updated_at": "2015-08-21 16:46:04", "account_number": "A1437916", "member_number": "3847", "member_name": "柴华", "beds": "6号楼-6-112-422", "account_balance": "4756.41", "beds_cost": "566.78", "meal_cost": "208.33", "nursing_cost": "782.02", "other_cost": "313.21", "cd_card": "348614614844405522" } } ] }
         * @return_param business_time          char    业务时间，时间格式为：Y-m-d H:i:s      
         * @return_param voucher_no             char    收款单号                               
         * @return_param account_id             int     账户id                                 
         * @return_param payment_type           char    收费类型，0表示入住收费，1表示变更收费 
         * @return_param amount_receivable      double  应收金额，单位元，保留两位小数         
         * @return_param amount_balance         double  帐号余额，单位元，保留两位小数         
         * @return_param billing_date           char    账单日期,时间格式为：Y-m-d H:i:s       
         * @return_param if_pay                 int     是否已经收费，0未收费，1收费了         
         * @remark 备注
         */
    public function showWithIfPay($ifPay, Request $request)
    {
        $page      = $request->page      ?? 1;
        $page_size = $request->page_size ?? 15;
        $credits   = $this->creditManagementService->showWithIfPay($ifPay, $page, $page_size);

        return $credits;
    }


        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title 增加账单
         * @description 增加账单
         * @method POST  application/json
         * @url {{host}}/api/financial-management/IfPay/{ifPay}
         * @param business_time      是    char    业务时间，时间格式为：Y-m-d H:i:s      
         * @param voucher_no         是    char    收款单号                               
         * @param account_id         是    int     账户id                                 
         * @param payment_type       是    char    收费类型，0表示入住收费，1表示变更收费 
         * @param amount_receivable  是    double  应收金额，单位元，保留两位小数         
         * @param amount_balance     是    double  帐号余额，单位元，保留两位小数         
         * @param billing_date       是    char    账单日期,时间格式为：Y-m-d H:i:s       
         * @param if_pay             是    int     是否已经收费，0未收费，1收费了         
         * @json_param { "business_time": "1993-07-21 10:02:42", "voucher_no": "SK41993072150472570", "payment_type": "0", "amount_receivable": "19022.06", "account_balance": "1016.27", "billing_date": "1993-07-21 10:02:42", "if_pay": "1", "account_id": "2" }`
         * @return { "status": 200, "message": "操作成功", "data": { "voucher_no": "SK41993072150472570" } }
         * @return_param voucher_no char 收款单号
         * @remark 备注
         */
    public function store(CreditManagementRequest $request)
    {
        $bill = $request->post();

        return $this->creditManagementService->store($bill);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title 删除账单
         * @description 删除账单
         * @method DELETE  application/json
         * @url {{host}}/api/financial-management/{VoucherNo}
         * @param VoucherNo  是    char  收款单号 
         * @json_param `{host}/api/financial-management/collection/SK41995040139727931`
         * @return { "status": 200, "message": "操作成功", "data": { "voucher_no": "SK41993072150472570" } }
         * @return_param voucher_no char 收款单号
         * @remark 备注
         */
    public function destory($voucherNo)
    {
        return $this->creditManagementService->destory($voucherNo);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/收款
         * @title　更新账单
         * @description 更新账单
         * @method DELETE  application/json
         * @url {{host}}/api/financial-management/{VoucherNo}
         * @param business_time      否    char    业务时间，时间格式为：Y-m-d H:i:s      
         * @param voucher_no         否    char    收款单号                               
         * @param account_id         否    int     账户id                                 
         * @param payment_type       否    char    收费类型，0表示入住收费，1表示变更收费 
         * @param amount_receivable  否    double  应收金额，单位元，保留两位小数         
         * @param amount_balance     否    double  帐号余额，单位元，保留两位小数         
         * @param billing_date       否    char    账单日期,时间格式为：Y-m-d H:i:s       
         * @param if_pay             否    int     是否已经收费，0未收费，1收费了         
         * @json_param `{host}/api/financial-management/collection/SK41995040139727931`
         * @return { "status": 200, "message": "操作成功", "data": { "voucher_no": "SK41993072150472570" } }
         * @return_param voucher_no char 收款单号
         * @remark 备注
         */
    public function update(Request $request)
    {
        $bill = $request->post();

        return $this->creditManagementService->update($bill);
    }
}
