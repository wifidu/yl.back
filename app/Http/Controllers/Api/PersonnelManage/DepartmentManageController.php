<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Http\Service\PersonnelManage\DepartmentManageService;
use App\Http\Requests\Api\PersonnelManage\DepartmentManageRequest;
use Dingo\Api\Contract\Http\Request;


class DepartmentManageController
{
    private $_departmentManageService;

    public function __construct(DepartmentManageService $DepartmentManageService)
    {
        $this->_departmentManageService = $DepartmentManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/部门管理
     * @title 部门数据存储
     * @description 部门数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/department-manage/
     * @param department_name 必选 string 部门名称
     * @param department_description 必选 string 部门描述
     * @json_param {"department_name":"前台11","department_description":"负责接待和电话转接"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"department_name":"前台12","department_description":"负责接待和电话转接","updated_at":"2020-04-04 09:13:55","created_at":"2020-04-04 09:13:55","id":9}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/人事管理/部门管理
     * @title 部门数据编辑
     * @description 部门数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/department-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param department_name 必选 string 部门名称
     * @param department_description 必选 string 部门描述
     * @json_param {"id":2,"department_name":"前台11","department_description":"负责接待和电话转接"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":2,"department_name":"前台12","department_description":"负责接待和电话转接","created_at":"2020-04-04 09:08:13","updated_at":"2020-04-04 09:08:25"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(DepartmentManageRequest $request)
    {
        $params = $request->post();
        return $this->_departmentManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/部门管理
     * @title 部门数据详情
     * @description 部门数据详情的接口
     * @method `GET`
     * @url  {{host}}/api/personnel-management/department-manage/{id}
     * @param id 必选 int 部门主键id
     * @return {"status":200,"message":"操作成功","data":{"id":2,"department_name":"前台11","department_description":"负责接待和电话转接","created_at":"2020-04-04 06:38:35","updated_at":"2020-04-04 06:38:35"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_departmentManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/部门管理
     * @title 部门数据删除
     * @description 部门数据删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/department-manage/{id}
     * @param id 必选 int 部门主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_departmentManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/部门管理
     * @title 部门数据列表
     * @description 部门数据列表的接口
     * @method `GET` `query_string`
     * @url  {{host}}/api/personnel-management/department-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":1,"department_name":"前台11","department_description":"负责接待和电话转接","created_at":"2020-04-04 06:38:33","updated_at":"2020-04-04 06:38:33"},{"id":2,"department_name":"前台11","department_description":"负责接待和电话转接","created_at":"2020-04-04 06:38:35","updated_at":"2020-04-04 06:38:35"}],"first_page_url":"http://59.110.212.116:32801/api/personnel-manage/department-manage/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/personnel-manage/department-manage/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/personnel-manage/department-manage/list","per_page":20,"prev_page_url":null,"to":2,"total":2}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_departmentManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/部门管理
     * @title 部门数据批量删除
     * @description 部门数据批量删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/department-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(DepartmentManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_departmentManageService->batchDelete($ids);
    }
}
