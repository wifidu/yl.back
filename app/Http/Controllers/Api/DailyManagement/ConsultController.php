<?php

/*
 * @author weifan
 * Monday 6th of April 2020 01:30:28 PM
 */

namespace App\Http\Controllers\Api\DailyManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DailyManagement\ConsultRequest;
use App\Http\Service\DailyManagement\ConsultService;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    protected $consultService;

    public function __construct(ConsultService $consultService)
    {
        $this->consultService = $consultService;
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/询问
         * @title 所有询问记录
         * @description 所有询问记录
         * @method GET  application/json
         * @url {{host}}/api/daily-management/consult
         * @param page false int 当前页数
         * @param page_size false int 页面数据量
         * @param start_time false date 开始时间
         * @param end_time false date 结束时间
         * @json_param yl.test/api/daily-management/consult?start_time=2013-07-15 19:50:42&end_time=2013-07-15 19:50:42
         * @return { "status": 200, "message": "操作成功", "data": { "current_page": 1, "data": [ { "id": 7, "time": "2013-07-15 19:50:42", "consultant": "解楠", "phone": "15926742083", "consult_type": 2, "intention": "了解情况", "member_name": "曲瑶", "age": 27, "selfcare_ability": 2, "note": "Magni illum aut aut repellat aliquam. Cupiditate eum explicabo praesentium aut eum et. Vitae et est enim numquam et dolores dolore velit.", "result": "已入住", "created_at": "1970-01-11 11:09:33", "updated_at": "1970-01-11 11:09:33" } ], "first_page_url": "http://yl.test/api/daily-management/consult?page=1", "from": 1, "last_page": 1, "last_page_url": "http://yl.test/api/daily-management/consult?page=1", "next_page_url": null, "path": "http://yl.test/api/daily-management/consult", "per_page": 15, "prev_page_url": null, "to": 1, "total": 1 } }
         * @return_param time  date 询问时间
         * @return_param consultant  string 询问者
         * @return_param phone  int 手机
         * @return_param consult_type  int 咨询方式，０来访、１电话、２书信
         * @return_param intention  意向 咨询意向
         * @return_param member_name  varchar 会员姓名，老人姓名
         * @return_param age  int  年龄
         * @return_param selfcare_ability  int 自理能力，０自理，１半自理，２失去自理
         * @return_param note  string 备注
         * @return_param result  string 咨询结果
         * @remark 备注
         */
    public function index(Request $request)
    {
        return $this->consultService->index($request->get('page', ''),
            $request->get('page_size', ''),
            $request->get('start_time', ''),
            $request->get('end_time', ''));
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/询问
         * @title 查询单个询问记录
         * @description 查询单个询问记录
         * @method GET  application/json
         * @url {{host}}/api/daily-management/consult
         * @param id true int 询问id
         * @json_param yl.test/api/daily-management/consult/3
         * @return { "status": 200, "message": "操作成功", "data": [ { "id": 3, "time": "1999-09-15 19:41:23", "consultant": "俞华", "phone": "18791433007", "consult_type": 2, "intention": "了解情况", "member_name": "向颖", "age": 37, "selfcare_ability": 1, "note": "Omnis quia voluptate quibusdam blanditiis accusantium molestiae impedit. Aut et ducimus enim accusamus perspiciatis.", "result": "准备入住", "created_at": "2019-05-23 01:29:29", "updated_at": "2019-05-23 01:29:29" } ] }
         * @return_param time  date 询问时间
         * @return_param consultant  string 询问者
         * @return_param phone  int 手机
         * @return_param consult_type  int 咨询方式，０来访、１电话、２书信
         * @return_param intention  意向 咨询意向
         * @return_param member_name  varchar 会员姓名，老人姓名
         * @return_param age  int  年龄
         * @return_param selfcare_ability  int 自理能力，０自理，１半自理，２失去自理
         * @return_param note  string 备注
         * @return_param result  string 咨询结果
         * @remark 备注
         */
    public function show($id)
    {
        return $this->consultService->show($id);
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/询问
         * @title　增加询问
         * @description 增加询问
         * @method PATCH  application/json
         * @url {{host}}/api/daily-management/consultant
         * @param time true date 询问时间
         * @param consultant true string 询问者
         * @param phone true int 手机
         * @param consult_type true int 咨询方式，０来访、１电话、２书信
         * @param intention true 意向 咨询意向
         * @param member_name true varchar 会员姓名，老人姓名
         * @param age true int  年龄
         * @param selfcare_ability true int 自理能力，０自理，１半自理，２失去自理
         * @param note true string 备注
         * @param result true string 咨询结果
         * @json_param { "time": "1986-12-05 05:38:36", "consultant": "都玉英", "phone": "13325915073", "consult_type": 1, "intention": "有意入住", "member_name": "关金凤", "age": 45, "selfcare_ability": 1, "note": "Optio delectus iure saepe asperiores. Sint autem nesciunt quia veniam quam eius. Rerum nobis autem reiciendis dolor voluptas ab. Reprehenderit sunt est consectetur ut.", "result": "准备入住", "created_at": "1998-02-25 19:23:54", "updated_at": "1998-02-25 19:23:54" }
         * @return { "status": 200, "message": "操作成功", "data": { "id": 22 } }
         * @return_param id int 询问id
         * @remark 备注
         */
    public function store(ConsultRequest $request)
    {
        return $this->consultService->store($request->post());
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/询问
         * @title　更新询问
         * @description 更新询问
         * @method PATCH  application/json
         * @url {{host}}/api/daily-management/consultant
         * @param id true int 访问id
         * @param time false date 询问时间
         * @param consultant false string 询问者
         * @param phone false int 手机
         * @param consult_type false int 咨询方式，０来访、１电话、２书信
         * @param intention false 意向 咨询意向
         * @param member_name false varchar 会员姓名，老人姓名
         * @param age false int  年龄
         * @param selfcare_ability false int 自理能力，０自理，１半自理，２失去自理
         * @param note false string 备注
         * @param result false string 咨询结果
         * @json_param { "id":21, "time": "1986-12-05 05:38:36", "consultant": "都玉英", "phone": "13325915073", "consult_type": 1, "intention": "有意入住", "member_name": "金凤", "age": 45, "selfcare_ability": 1, "note": "Optio delectus iure saepe asperiores. Sint autem nesciunt quia veniam quam eius. Rerum nobis autem reiciendis dolor voluptas ab. Reprehenderit sunt est consectetur ut.", "result": "准备入住", "created_at": "1998-02-25 19:23:54", "updated_at": "1998-02-25 19:23:54" }
         * @return { "status": 200, "message": "操作成功", "data": { "id": 21 } }
         * @return_param id int 询问id
         * @remark 备注
         */
    public function update(ConsultRequest $request)
    {
        return $this->consultService->update($request->all());
    }

        /**
         * showdoc
         * @catalog 接口文档/日常管理/询问
         * @title　删除询问
         * @description 删除询问
         * @method PATCH  application/json
         * @url {{host}}/api/daily-management/consultant/{id}
         * @param id true int 访问id
         * @json_param yl.test/api/daily-management/consult/1
         * @return { "status": 200, "message": "操作成功", "data": { "id": "1" } }
         * @return_param id int 询问id
         * @remark 备注
         */
    public function destroy($id)
    {
        return $this->consultService->destroy($id);
    }
}
