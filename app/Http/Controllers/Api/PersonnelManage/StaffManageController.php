<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Http\Service\PersonnelManage\StaffManageService;
use App\Http\Requests\Api\PersonnelManage\StaffManageRequest;
use Dingo\Api\Contract\Http\Request;


class StaffManageController
{
    private $_staffManageService;

    public function __construct(StaffManageService $StaffManageService)
    {
        $this->_staffManageService = $StaffManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/员工管理
     * @title 员工数据存储
     * @description 员工数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/staff-manage/
     * @param user_id 非必选 int 用户id
     * @param staff_name 必选 string 员工姓名
     * @param sex 必选 tinyint 性别
     * @param id_number 必选 string 身份证号
     * @param birth_date 必选 string 出生日期
     * @param subordinate_department 必选 string 所属部门
     * @param subordinate_team 必选 string 所属团队
     * @param nation 必选 string 民族
     * @param position_rank 必选 string 岗位职级
     * @param phone_number 必选 string 电话号码
     * @param staff_type 必选 tinyint 员工类型(0-劳动合同工1-临时工)
     * @param start_time 必选 int 合同开始时间
     * @param end_time 必选 int 合同结束时间
     * @param staff_status 必选 tinyint 员工状态(0-在职1-离职)
     * @param bank 必选 string 开户行
     * @param bank_card_number 必选 string 银行卡号
     * @json_param {"staff_name":"小明","sex":0,"id_number":"360730202002022020","birth_date":"20200202","subordinate_department":"前台","subordinate_team":"第一团队","nation":"汉","position_rank":"前台负责人","phone_number":"13456789012","staff_type":0,"start_time":1580572800,"end_time":2211724800,"staff_status":0,"bank":"中国建设银行","bank_card_number":"6217002020051234567"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"staff_name":"小明","sex":"0","id_number":"360730202002022020","birth_date":"20200202","subordinate_department":"前台","subordinate_team":"第一团队","nation":"汉","position_rank":"前台负责人","phone_number":"13456789012","staff_type":"0","start_time":"1580572800","staff_status":"0","bank":"中国建设银行","bank_card_number":"6217002020051234567","end_time":"2211724800","updated_at":"2020-04-04 07:33:57","created_at":"2020-04-04 07:33:57","id":19}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/人事管理/员工管理
     * @title 员工数据编辑
     * @description 员工数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/staff-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param user_id 非必选 int 用户id
     * @param staff_name 必选 string 员工姓名
     * @param sex 必选 tinyint 性别
     * @param id_number 必选 string 身份证号
     * @param birth_date 必选 string 出生日期
     * @param subordinate_department 必选 string 所属部门
     * @param subordinate_team 必选 string 所属团队
     * @param nation 必选 string 民族
     * @param position_rank 必选 string 岗位职级
     * @param phone_number 必选 string 电话号码
     * @param staff_type 必选 tinyint 员工类型(0-劳动合同工1-临时工)
     * @param start_time 必选 int 合同开始时间
     * @param end_time 必选 int 合同结束时间
     * @param staff_status 必选 tinyint 员工状态(0-在职1-离职)
     * @param bank 必选 string 开户行
     * @param bank_card_number 必选 string 银行卡号
     * @json_param {"id":17,"staff_name":"小明明","sex":0,"id_number":"360730202002022020","birth_date":"20200202","subordinate_department":"前台","subordinate_team":"第一团队","nation":"汉","position_rank":"前台负责人","phone_number":"13456789012","staff_type":0,"start_time":1580572800,"end_time":2211724800,"staff_status":0,"bank":"中国建设银行","bank_card_number":"6217002020051234567"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":17,"user_id":null,"staff_name":"小明明","sex":"0","id_number":"360730202002022020","birth_date":"20200202","subordinate_department":"前台","subordinate_team":"第一团队","nation":"汉","position_rank":"前台负责人","phone_number":"13456789012","staff_type":"0","start_time":"1580572800","end_time":"2211724800","staff_status":"0","bank":"中国建设银行","bank_card_number":"6217002020051234567","created_at":"2020-04-04 07:13:35","updated_at":"2020-04-04 09:26:46"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(StaffManageRequest $request)
    {
        $params = $request->post();
        return $this->_staffManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/员工管理
     * @title 员工数据详情
     * @description 员工数据详情的接口
     * @method `GET`
     * @url  {{host}}/api/personnel-management/staff-manage/{id}
     * @param id 必选 int 员工主键id
     * @return {"status":200,"message":"操作成功","data":{"id":19,"user_id":null,"staff_name":"小明","sex":0,"id_number":"360730202002022020","birth_date":"20200202","subordinate_department":"前台","subordinate_team":"第一团队","nation":"汉","position_rank":"前台负责人","phone_number":"13456789012","staff_type":0,"start_time":1580572800,"end_time":2211724800,"staff_status":0,"bank":"中国建设银行","bank_card_number":"6217002020051234567","created_at":"2020-04-04 07:33:57","updated_at":"2020-04-04 07:33:57"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_staffManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/员工管理
     * @title 员工数据删除
     * @description 员工数据删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/staff-manage/{id}
     * @param id 必选 int 员工主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_staffManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/员工管理
     * @title 员工数据列表
     * @description 员工数据列表的接口
     * @method `GET` `query_string`
     * @url  {{host}}/api/personnel-management/staff-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":17,"user_id":null,"staff_name":"小明","sex":0,"id_number":"360730202002022020","birth_date":"20200202","subordinate_department":"前台","subordinate_team":"第一团队","nation":"汉","position_rank":"前台负责人","phone_number":"13456789012","staff_type":0,"start_time":1580572800,"end_time":2211724800,"staff_status":0,"bank":"中国建设银行","bank_card_number":"6217002020051234567","created_at":"2020-04-04 07:13:35","updated_at":"2020-04-04 07:13:35"}],"first_page_url":"http://59.110.212.116:32801/api/personnel-manage/staff-manage/list?page=1","from":1,"last_page":2,"last_page_url":"http://59.110.212.116:32801/api/personnel-manage/staff-manage/list?page=2","next_page_url":"http://59.110.212.116:32801/api/personnel-manage/staff-manage/list?page=2","path":"http://59.110.212.116:32801/api/personnel-manage/staff-manage/list","per_page":"1","prev_page_url":null,"to":1,"total":2}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_staffManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/员工管理
     * @title 员工数据批量删除
     * @description 员工数据批量删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/staff-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(StaffManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_staffManageService->batchDelete($ids);
    }
}
