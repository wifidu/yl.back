<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Events\PositionManage;
use App\Http\Service\PersonnelManage\PositionManageService;
use App\Http\Requests\Api\PersonnelManage\PositionManageRequest;
use Dingo\Api\Contract\Http\Request;


class PositionManageController
{
    private $_positionManageService;

    public function __construct(PositionManageService $PositionManageService)
    {
        $this->_positionManageService = $PositionManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/岗位管理
     * @title 岗位数据存储
     * @description 岗位数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/position-manage/
     * @param position_name 必选 string 岗位名称
     * @param position_type 必选 tinyint 岗位类型(0-行政岗1-财务岗2-护理岗3-管理岗)
     * @param position_salary 必选 decimal 岗位薪水(元/每单)
     * @param rank_name 必选 string 职级名称
     * @param rank_salary 必选 decimal 职级薪水(元/每单)
     * @param position_description 必选 text 岗位描述
     * @json_param {"position_name":"前台","position_type":0,"position_salary":7000,"rank_name":"见习生","rank_salary":4000,"position_description":"负责接待和电话转接"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"position_name":"前台","position_type":"0","position_salary":"7000","rank_name":"见习生","rank_salary":"4000","position_description":"负责接待和电话转接","updated_at":"2020-04-04 06:58:08","created_at":"2020-04-04 06:58:08","id":12}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/人事管理/岗位管理
     * @title 岗位数据编辑
     * @description 岗位数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/personnel-management/position-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param position_name 必选 string 岗位名称
     * @param position_type 必选 tinyint 岗位类型(0-行政岗1-财务岗2-护理岗3-管理岗)
     * @param position_salary 必选 decimal 岗位薪水(元/每单)
     * @param rank_name 必选 string 职级名称
     * @param rank_salary 必选 decimal 职级薪水(元/每单)
     * @param position_description 必选 text 岗位描述
     * @json_param {"id":11,"position_name":"前台1","position_type":0,"position_salary":7000,"rank_name":"见习生","rank_salary":4000,"position_description":"负责接待和电话转接"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":11,"role_id":17,"position_name":"前台1","position_type":"0","position_salary":"7000","rank_name":"见习生","rank_salary":"4000","position_description":"负责接待和电话转接","created_at":"2020-03-24 17:54:14","updated_at":"2020-04-04 09:21:33"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(PositionManageRequest $request)
    {
        $params = $request->post();
        return $this->_positionManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/岗位管理
     * @title 岗位数据详情
     * @description 岗位数据详情的接口
     * @method `GET`
     * @url  {{host}}/api/personnel-management/position-manage/{id}
     * @param id 必选 int 岗位主键id
     * @return {"status":200,"message":"操作成功","data":{"id":12,"role_id":null,"position_name":"前台","position_type":0,"position_salary":"7000.00","rank_name":"见习生","rank_salary":"4000.00","position_description":"负责接待和电话转接","created_at":"2020-04-04 06:58:08","updated_at":"2020-04-04 06:58:08"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_positionManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/岗位管理
     * @title 岗位数据删除
     * @description 岗位数据删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/position-manage/{id}
     * @param id 必选 int 岗位主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_positionManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/岗位管理
     * @title 岗位数据列表
     * @description 岗位数据列表的接口
     * @method `GET` `query_string`
     * @url  {{host}}/api/personnel-management/position-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":11,"role_id":17,"position_name":"admin","position_type":1,"position_salary":"88.00","rank_name":"正院长","rank_salary":"99.00","position_description":null,"created_at":"2020-03-24 17:54:14","updated_at":"2020-03-24 17:54:15"}],"first_page_url":"http://59.110.212.116:32801/api/personnel-manage/position-manage/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/personnel-manage/position-manage/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/personnel-manage/position-manage/list","per_page":20,"prev_page_url":null,"to":1,"total":1}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_positionManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/人事管理/岗位管理
     * @title 岗位数据批量删除
     * @description 岗位数据批量删除的接口
     * @method `DELETE`
     * @url  {{host}}/api/personnel-management/position-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(PositionManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_positionManageService->batchDelete($ids);
    }
}
