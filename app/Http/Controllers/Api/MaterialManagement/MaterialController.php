<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\MaterialService;
use App\Http\Requests\Api\MaterialManagement\MaterialRequest;

class MaterialController
{
    private $_materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->_materialService = $materialService;
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资
     * @title 物资数据存储
     * @description 物资数据存储的接口
     * @method `post` `application/json`
     * @url {{host}}/api/material-management/material/
     * @param name 必选 string 物资名称
     * @param brand 必选 string 品牌
     * @param model 必选 string 型号
     * @param unit 必选 int 单位(见备注)
     * @json_param {"name":"飞利浦灯泡","brand":"飞利浦","model":"Y00055","unit":0}
     * @return  {"status":200,"message":"操作成功","data":{"id":{"name":"飞利浦灯泡","brand":"飞利浦","model":"Y00055","unit":0,"updated_at":"2020-04-14 11:05:10","created_at":"2020-04-14 11:05:10","id":10}}}
     * @return_param id int 物资id
     * @return_param name string 物资名称
     * @return_param brand string 品牌
     * @return_param model string 型号
     * @return_param unit    int 单位(见备注)
     * @remark 单位(0-支 1-个 2-包)
     */
    public function store(MaterialRequest $request)
    {
        $params = $request->post();
        return $this->_materialService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资
     * @title 物资数据详情
     * @description 物资数据详情的接口
     * @method `post` `application/json`
     * @url {{host}}/api/material-management/material/{id}
     * @param id 否 int 主键(id和name二选一,必须有一个)
     * @param name 否 string 物资名称
     * @return  {"status":200,"message":"操作成功","data":{"id":8,"name":"飞利浦","brand":"飞利浦","model":"y-111","unit":0,"number":7700,"supplier":"上海飞利浦有限公司","created_at":"2020-03-01 13:14:43","updated_at":"2020-03-24 12:17:03","mate":[{"id":1,"odd_number":"CK20200302","type":1,"warehouse_name":"华南AB","material_name":"飞利浦","material_id":8,"brand":"飞利浦","supplier":"飞利浦","unit":0,"price":"13.00","number":100,"total":"1300.00","operator":"彭超超","operator_time":1583402054,"created_at":"2020-03-05 09:53:00","updated_at":"2020-03-05 09:54:15"},{"id":3,"odd_number":"RK20200229","type":2,"warehouse_name":"华南A","material_name":"飞利浦","material_id":8,"brand":"飞利浦","supplier":"飞利浦","unit":0,"price":"12.00","number":100,"total":"1200.00","operator":"彭超超","operator_time":1583402098,"created_at":"2020-03-05 09:54:58","updated_at":"2020-03-05 09:54:58"}]}}
     * @return_param id int 物资id
     * @return_param name string 物资名称
     * @return_param brand string 品牌
     * @return_param model string 型号
     * @return_param number string 数量
     * @return_param supplier string 供应商
     * @return_param unit int 单位(见备注)
     * @return_param mate.id int 仓库日志id
     * @return_param mate.odd_number int 单号
     * @return_param mate.type int 类操作型(见备注)
     * @return_param mate.warehouse_name string 仓库名称
     * @return_param mate.material_name string 物资名称
     * @return_param mate.material_id string 物资id
     * @return_param mate.brand string 品牌
     * @return_param mate.supplier string 供应商
     * @return_param mate.unit int 单位(见备注)
     * @return_param mate.price string 价格
     * @return_param mate.number int 数量
     * @return_param mate.total string 总计金额
     * @return_param mate.operator int 操作人
     * @return_param mate.operator_time int 操作时间
     * @remark 单位(0-支 1-个 2-包)
     */
    public function detail(MaterialRequest $request)
    {
        $id = $request->id ?? null;
        $name = $request->name ?? null;
        return $this->_materialService->detail($id, $name);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资
     * @title 物资数据列表
     * @description 物资数据列表的接口
     * @method `get` `query_string`
     * @param page 非必选 string 物资名称
     * @param page_size 非必选 string 物资名称
     * @url {{host}}/api/material-management/material/list
     * @json_param 参数以query_string的形式连接在url后。例如：{{host}}/api/material-management/material/list?page=1&page_size=10
     * @return  {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":3,"name":"飞利浦灯泡","brand":"飞利浦","model":"Y00055","unit":0,"number":0,"supplier":null,"created_at":"2020-03-01 12:31:56","updated_at":"2020-03-01 12:31:56"}],"first_page_url":"http://59.110.212.116:32801/api/material-management/material/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/material-management/material/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/material-management/material/list","per_page":"10","prev_page_url":null,"to":5,"total":5}}
     * @return_param id int 物资id
     * @return_param name string 物资名称
     * @return_param brand string 品牌
     * @return_param model string 型号
     * @return_param number string 数量
     * @return_param supplier string 供应商
     * @return_param unit int 单位(见备注)
     * @return_param first_page_url string 第一页地址
     * @return_param from int 第一页页
     * @return_param last_page int 最后一页
     * @return_param last_page_url string 最后一页地址
     * @return_param next_page_url string 下一页页地址
     * @return_param path string 当前接口地址
     * @return_param per_page string 上一页页数
     * @return_param prev_page_url string 上一页地址
     * @return_param to int 当前页
     * @return_param total int 总页数
     * @remark 单位(0-支 1-个 2-包)
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_materialService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资
     * @title 物资删除
     * @description 物资删除的接口
     * @method `delete`
     * @url  {{host}}/api/material-management/material/{id}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_materialService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资
     * @title 物资批量删除
     * @description 物资批量删除的接口
     * @method `delete`
     * @url  {{host}}/api/material-management/material/
     * @param ids 必选 array 待删除数据项主键id数组
     * @json_param {"ids":[5,6,7]}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(MaterialRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_materialService->batchDelete($ids);
    }
}
