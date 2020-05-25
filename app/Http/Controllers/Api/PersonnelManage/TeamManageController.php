<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Http\Service\PersonnelManage\TeamManageService;
use App\Http\Requests\Api\PersonnelManage\TeamManageRequest;
use Dingo\Api\Contract\Http\Request;


class TeamManageController
{
    private $_teamManageService;

    public function __construct(TeamManageService $TeamManageService)
    {
        $this->_teamManageService = $TeamManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/团队管理
     * @title 团队数据存储
     * @description 团队数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/team-manage/
     * @param team_name 必选 string 团队名称
     * @param service_type 必选 string 服务类型
     * @param team_description 必选 string 团队描述
     * @param team_members 必选 string 团队成员
     * @param header 必选 string 负责人
     * @param bed_assignment 必选 json 床位分配
     * @json_param {"team_name":"前台1","service_type":"生活类","team_description":"争做前一","team_members":"小明，小张，小陈","header":"小明","bed_assignment":{"小明":"1","小张":"2","小陈":"3"}}
     * @return {"status":200,"message":"操作成功","data":{"id":{"team_name":"前台1","service_type":"生活类","team_description":"争做前一","team_members":"小明，小张，小陈","header":"小明","bed_assignment":{"小明":"1","小张":"2","小陈":"3"},"updated_at":"2020-04-04 10:01:23","created_at":"2020-04-04 10:01:23","id":5}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/人事管理/团队管理
     * @title 团队数据编辑
     * @description 团队数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/team-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param team_name 必选 string 团队名称
     * @param service_type 必选 string 服务类型
     * @param team_description 必选 string 团队描述
     * @param team_members 必选 string 团队成员
     * @param header 必选 string 负责人
     * @param bed_assignment 必选 json 床位分配
     * @json_param {"id":4,"team_name":"前台2","service_type":"生活类","team_description":"争做前一","team_members":"小明，小张，小陈","header":"小明","bed_assignment":{"小明":"1","小张":"2","小陈":"3"}}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":4,"team_name":"前台2","service_type":"生活类","team_description":"争做前一","team_members":"小明，小张，小陈","header":"小明","bed_assignment":{"小明":"1","小张":"2","小陈":"3"},"created_at":"2020-04-04 09:59:15","updated_at":"2020-04-04 10:03:28"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(TeamManageRequest $request)
    {
        $params = $request->post();
        return $this->_teamManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/团队管理
     * @title 团队数据详情
     * @description 团队数据详情的接口
     * @method `GET`
     * @url  {{host}}/api/personnel-management/team-manage/{id}
     * @param id 必选 int 团队主键id
     * @return {"status":200,"message":"操作成功","data":{"id":4,"team_name":"前台2","service_type":"生活类","team_description":"争做前一","team_members":"小明，小张，小陈","header":"小明","bed_assignment":"{\"小张\": \"2\", \"小明\": \"1\", \"小陈\": \"3\"}","created_at":"2020-04-04 09:59:15","updated_at":"2020-04-04 10:03:28"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_teamManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/团队管理
     * @title 团队数据删除
     * @description 团队数据删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/team-manage/{id}
     * @param id 必选 int 团队主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_teamManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/团队管理
     * @title 团队数据列表
     * @description 团队数据列表的接口
     * @method `GET` `query_string`
     * @url  {{host}}/api/personnel-management/team-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":4,"team_name":"前台1","service_type":"生活类","team_description":"争做前一","team_members":"小明，小张，小陈","header":"小明","bed_assignment":"{\"小张\": \"2\", \"小明\": \"1\", \"小陈\": \"3\"}","created_at":"2020-04-04 09:59:15","updated_at":"2020-04-04 09:59:15"}],"first_page_url":"http://59.110.212.116:32801/api/personnel-manage\\/team-manage\\/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/personnel-manage\\/team-manage\\/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/personnel-manage\\/team-manage\\/list","per_page":20,"prev_page_url":null,"to":1,"total":1}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_teamManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/团队管理
     * @title 团队数据批量删除
     * @description 团队数据批量删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/team-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(TeamManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_teamManageService->batchDelete($ids);
    }
}
