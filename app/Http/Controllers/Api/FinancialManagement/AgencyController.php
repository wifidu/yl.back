<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 11:52:58 AM
 */

namespace App\Http\Controllers\Api\FinancialManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FinancialManagement\AgencyRequest;
use App\Http\Service\FinancialManagement\AgencyService;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    protected $agencyService;

    public function __construct(AgencyService $agencyService)
    {
        $this->agencyService = $agencyService;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/机构账户
         * @title 查询所有账单
         * @description 查询所有账单
         * @method GET  application/json
         * @url {{host}}/api/financial-management/agency
         * @param start_time       否    char  开始时间，格式：2015-04-26 17:52:38 
         * @param end_time         否    char  截至时间，格式同上                  
         * @param business_number  否    char  业务编号                            
         * @json_param `{host}/api/financial-management/agency?start_time=2015-04-26 17:52:38&end_time=2019-08-12 02:46:46`
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 1, "data": [ { "id": 5, "created_at": "2015-12-29 22:21:06", "updated_at": "2015-12-29 22:21:06", "serial_number": "LS42020030152561597", "business_number": "SK42020030139515836", "financial_type": "退费", "money_flow": "收入", "transaction_amount": "1874.75", "payment_channel": "刷卡", "note": "Fuga nostrum sit excepturi neque praesentium incidunt assumenda." }, { "id": 11, "created_at": "2018-11-17 01:03:20", "updated_at": "2018-11-17 01:03:20", "serial_number": "LS42020030176969739", "business_number": "SK42020030112274181", "financial_type": "退费", "money_flow": "收入", "transaction_amount": "8655.04", "payment_channel": "现金", "note": "Repudiandae omnis eum dignissimos repellendus officia autem." } ], "first_page_url": "http://yl.test/api/financial-management/agency?page=1", "from": 1, "last_page": 1, "last_page_url": "http://yl.test/api/financial-management/agency?page=1", "next_page_url": null, "path": "http://yl.test/api/financial-management/agency", "per_page": 15, "prev_page_url": null, "to": 2, "total": 2 } }
         * @return_param serial_number       是    char    流水号                                        
         * @return_param business_number     是    char    业务账单                                      
         * @return_param financial_type      是    int     财务类型，0经营收费，1退费                    
         * @return_param money_flow          是    int     资金流向，0支出，1收入                        
         * @return_param payment_channel     是    int     支付渠道，0现金、1刷卡、2转帐、3微信、4支付宝 
         * @return_param note                是    string  备注                                          
         * @return_param transaction_amount  是    float   交易金额                                      
         * @remark 备注
         */
    public function show(Request $request)
    {
        $page            = $request->page            ?? 1;
        $page_size       = $request->page_size       ?? 15;
        $business_number = $request->business_number ?? null;
        $start_time      = $request->start_time      ?? null;
        $end_time        = $request->end_time        ?? null;

        return $this->agencyService->show($page,
                                          $page_size,
                                          $business_number,
                                          $start_time,
                                          $end_time);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/机构账户
         * @title 增加机构账户
         * @description 增加
         * @method POST  application/json
         * @url {{host}}/api/financial-management/agency
         * @param serial_number       是    char    流水号                                        
         * @param business_number     是    char    业务账单                                      
         * @param financial_type      是    int     财务类型，0经营收费，1退费                    
         * @param money_flow          是    int     资金流向，0支出，1收入                        
         * @param payment_channel     是    int     支付渠道，0现金、1刷卡、2转帐、3微信、4支付宝 
         * @param note                是    string  备注                                          
         * @param transaction_amount  是    float   交易金额                                      
         * @json_param { "serial_number": "LS42020030152561597", "business_number": "SK42020030139515836", "financial_type": "0", "money_flow": "0", "transaction_amount": "1874.75", "payment_channel": "0", "note": "阿三哦低级阿三哦打死你地哦按" }
         * @return { "status": 200, "message": "操作成功", "data": { "business_number": "SK42020030139515836" } }
         * @return_param business_number string 业务账单
         * @remark 备注
         */
    public function store(AgencyRequest $request)
    {
        $agency = $request->post();

        return $this->agencyService->store($agency);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/机构账户
         * @title 更新机构
         * @description 更新
         * @method PATCH  application/json
         * @url {{host}}/api/financial-management/agency
         * @param serial_number       否    char    流水号                                        
         * @param business_number     否    char    业务账单                                      
         * @param financial_type      否    int     财务类型，0经营收费，1退费                    
         * @param money_flow          否    int     资金流向，0支出，1收入                        
         * @param payment_channel     否    int     支付渠道，0现金、1刷卡、2转帐、3微信、4支付宝 
         * @param note                否    string  备注                                          
         * @param transaction_amount  否    float   交易金额                                      
         * @json_param { "serial_number": "LS42020030152561597", "business_number": "SK42020030139515836", "financial_type": "0", "money_flow": "0", "transaction_amount": "1874.75", "payment_channel": "0", "note": "裸考玫琳凯莫拉吗" }
         * @return { "status": 200, "message": "操作成功", "data": { "business_number": "SK42020030139515836" } }
         * @return_param business_number string 业务账单
         * @remark 备注
         */
    public function update(Request $request)
    {
        $agency = $request->all();

        return $this->agencyService->update($agency);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/机构账户
         * @title 删除账单
         * @description 删除账户
         * @method DELETE  application/json
         * @url {{host}}/api/financial-management/agency
         * @param business_number  是    char  业务编号 
         * @json_param `{host}/api/financial-management/agency/SK42020030123758692`
         * @return { "status": 200, "message": "操作成功", "data": { "business_number": "SK42020030123758692" } }
         * @return_param business_number string 业务账单
         * @remark 备注
         */
    public function destory($business_number)
    {
        return $this->agencyService->destory($business_number);
    }
}
