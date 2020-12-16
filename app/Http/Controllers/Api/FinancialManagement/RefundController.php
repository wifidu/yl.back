<?php

namespace App\Http\Controllers\Api\FinancialManagement;

use Illuminate\Http\Request;
use App\Http\Requests\Api\FinancialManagement\RefundRequest;
use App\Http\Controllers\Controller;
use App\Http\Service\FinancialManagement\RefundService;

class RefundController extends Controller
{
    protected $refundService;

    public function __construct(RefundService $refundService)
    {
        $this->refundService = $refundService;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/退款
         * @title 账单查询
         * @description 账单查询
         * @method GET  application/json
         * @url {{host}}/api/financial-management/refund
         * @param 变量名 true 类型 变量说明
         * @param page       否    `int`   当前页数，默认1                                                 
         * @param page_size  否    `int`   页面数据数目，默认15                                            
         * @param type       否    `int`   退款类型：0变更退费，1请假退费，2押金退费，3退院退费，4直接退费 
         * @param status     否    `int`   退款状态：0未退款，1已退款                                      
         * @param no         否    `char`  退款单号                                                        
         * @json_param `{host}/api/financial-management/refund/?page=1&page_size=3&status=0&type=0`
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 1, "data": [ { "id": 2, "created_at": "1983-04-17 03:28:07", "updated_at": "1983-04-17 03:28:07", "business_time": "2009-04-20 09:16:40", "refund_no": "FK2009042040956751", "account_id": 12, "refund_type": "变更收费", "refund_amount": "1498.91", "spending_way": "刷卡", "refund_status": "未退款", "refund_date": null, "agent": "袁龙", "note": "Quia ut quam sit possimus mollitia libero iusto veritatis.", "real_refund": "848.49", "deposit": "567.52", "refund_name": "molestiae", "account": { "id": 12, "created_at": "1982-01-04 02:14:12", "updated_at": "1982-01-04 02:14:12", "account_number": "A3568779", "member_number": "8641", "member_name": "许成", "beds": "3号楼-6-269-217", "account_balance": "6193.15", "beds_cost": "473.41", "meal_cost": "481.72", "nursing_cost": "188.34", "other_cost": "281.86", "cd_card": "503098838085068286", "deposit": "1375.65" } }, { "id": 4, "created_at": "2009-06-20 23:50:27", "updated_at": "2009-06-20 23:50:27", "business_time": "2014-12-07 15:14:35", "refund_no": "FK2014120726140587", "account_id": 2, "refund_type": "变更收费", "refund_amount": "4905.54", "spending_way": "刷卡", "refund_status": "未退款", "refund_date": null, "agent": "于文彬", "note": "Aut iste ut deserunt quam ut minus.", "real_refund": "894.80", "deposit": "671.97", "refund_name": "error", "account": { "id": 2, "created_at": "1988-10-02 09:59:56", "updated_at": "1988-10-02 09:59:56", "account_number": "A5653591", "member_number": "1196", "member_name": "来淑英", "beds": "3号楼-2-717-768", "account_balance": "6423.63", "beds_cost": "419.61", "meal_cost": "679.22", "nursing_cost": "25.65", "other_cost": "463.22", "cd_card": "492822069600925021", "deposit": "835.90" } } ], "first_page_url": "http://yl.test/api/financial-management/refund?page=1", "from": 1, "last_page": 1, "last_page_url": "http://yl.test/api/financial-management/refund?page=1", "next_page_url": null, "path": "http://yl.test/api/financial-management/refund", "per_page": "3", "prev_page_url": null, "to": 2, "total": 2 } }
         * @return_param 返回参数名 类型 说明
         * @remark 备注
         */
    public function show(Request $request)
    {
        $results = $this->refundService->show($request->get('page', 1),
                                              $request->get('page_size', 15),
                                              $request->get('type', null),
                                              $request->get('status', null),
                                              $request->get('no', null));

        return $results;
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/退款
         * @title 新增账单
         * @description 新增账单
         * @method POST  application/json
         * @url {{host}}/api/financial-management/refund
         * @param business_time  是    int    业务时间                                                        
         * @param refund_no      是    char   退款单号                                                        
         * @param account_id     是    int    账户id                                                          
         * @param refund_type    是    int    退款类型：0变更退费，1请假退费，2押金退费，3退院退费，4直接退费 
         * @param refund_amount  是    float  退款金额                                                        
         * @param spending_way   是    int    支出方式：0现金，1刷卡，2转账，3微信，4支付宝                   
         * @param refund_status  是    int    退款状态：0未退款，1已退款                                      
         * @param agent          是    char   经办人                                                          
         * @param refund_date    是    int    退款日期（如果未退款，退款日期返回-1）                          
         * @param note           是    char   备注                                                            
         * @param real_refund    是    float  实际退款                                                        
         * @param deposit        是    float  存入个人账户                                                    
         * @param refund_name    是    char   费用名称                                                        
         * @json_param { "business_time": "1979-07-26 10:18:51", "refund_no": "FK1979072615556493", "account_id": 1, "refund_type": "0", "refund_amount": "5478.97", "spending_way": "1", "refund_status": "0", "refund_date": -1, "agent": "鲁金凤", "note": "Accusantium veritatis ad fugiat ut.", "real_refund": "619.09", "deposit": "817.05", "refund_name": "sunt" }
         * @return { "status": 200, "message": "操作成功", "data": { "refund_no": "FK1979072615556493" } }
         * @return_param refund_no char 退款单号
         * @remark 备注
         */
    public function store(RefundRequest $request)
    {
        $reufnd = $request->post();
        return $this->refundService->store($reufnd);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/退款
         * @title 账单删除
         * @description 账单删除
         * @method DELETE  application/json
         * @url {{host}}/api/financial-management/refund/{no}
         * @param no        是    char  账单号 
         * @json_param `{host}/api/financial-management/refund/FK2012051854107835`
         * @return { "status": 200, "message": "操作成功", "data": { "refund_no": "FK2012051854107835" } }
         * @return_param refund_no char 退款单号
         * @remark 备注
         */
    public function destory($no)
    {
        return $this->refundService->destory($no);
    }

        /**
         * showdoc
         * @catalog 接口文档/财务管理/退款
         * @title 更新退款账单
         * @description 更新
         * @method PATCH  application/json
         * @url {{host}}/api/financial-management/refund
         * @param business_time  否    int    业务时间                                                        
         * @param refund_no      是    char   退款单号                                                        
         * @param account_id     否    int    账户id                                                          
         * @param refund_type    否    int    退款类型：0变更退费，1请假退费，2押金退费，3退院退费，4直接退费 
         * @param refund_amount  否    float  退款金额                                                        
         * @param spending_way   否    int    支出方式：0现金，1刷卡，2转账，3微信，4支付宝                   
         * @param refund_status  否    int    退款状态：0未退款，1已退款                                      
         * @param agent          否    char   经办人                                                          
         * @param refund_date    否    int    退款日期（如果未退款，退款日期返回-1）                          
         * @param note           否    char   备注                                                            
         * @param real_refund    否    float  实际退款                                                        
         * @param deposit        否    float  存入个人账户                                                    
         * @param refund_name    否    char   费用名称                                                        
         * @json_param { "business_time": "1979-07-26 10:18:51", "refund_no": "FK2012051854107835", "account_id": 1, "refund_type": "0", "refund_amount": "5478.97", "spending_way": "1", "refund_status": "0", "refund_date": -1, "agent": "张飞", "note": "Accusantium veritatis ad fugiat ut.", "real_refund": "619.09", "deposit": "817.05", "refund_name": "sunt" }
         * @return { "status": 200, "message": "操作成功", "data": { "refund_no": "FK2012051854107835" } }
         * @return_param refund_no char 退款单号
         * @remark 备注
         */
    public function update(Request $request)
    {
        $refund = $request->all();
        return $this->refundService->update($refund);
    }
}
