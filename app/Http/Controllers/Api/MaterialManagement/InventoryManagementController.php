<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\InventoryManagementService;
use App\Http\Requests\Api\MaterialManagement\InventoryManagementRequest;
use Dingo\Api\Contract\Http\Request;


class InventoryManagementController
{
    private $_inventoryManagementService;

    public function __construct(InventoryManagementService $inventoryManagementService)
    {
        $this->_inventoryManagementService = $inventoryManagementService;
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 保存盘点人盘点信息
     * @description 保存盘点人盘点信息的接口
     * @method `post` `application/json`
     * @url  {{host}}/api/material-management/material-out/
     * @param id 必选 string 盘点信息id
     * @param inventory_losses 必选 int 盘盈
     * @param inventory_surplus 必选 int 盘亏
     * @param check_person 必选 string 盘点人
     * @json_param {"id":15,"inventory_losses":12,"inventory_surplus":20,"check_person":"彭超超"}
     * @return  {"status":200,"message":"操作成功","data":{"id":{"id":15,"inventory_time":1582989516,"name":"02月份盘点","number":400,"total":"4800.00","inventory_losses":12,"inventory_surplus":20,"check_person":"彭超超","completion_time":1586845250,"type":null,"created_at":"2020-02-29 15:18:39","updated_at":"2020-04-14 14:20:50"}}}
     * @return_param id int 盘点信息id
     * @return_param inventory_time int 盘点时间
     * @return_param name string 盘点名称
     * @return_param number string 盘点数量
     * @return_param total string 合计金额
     * @return_param inventory_losses int 盘亏
     * @return_param inventory_surplus int 盘盈
     * @return_param check_person string 盘点人
     * @return_param completion_time int 完成时间
     * @return_param type int 盘点完成状态(见备注)
     * @remark 盘点完成状态(0-未盘点1-已盘点)
     */
    public function store(InventoryManagementRequest $request)
    {
        $params = $request->post();
        return $this->_inventoryManagementService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 盘点数据详情
     * @description 盘点数据详情的接口
     * @method `get`
     * @url  {{host}}/api/material-management/inventory-management/{id}
     * @json_param {id}为所要查询数据的主键id,添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":{"id":15,"inventory_time":1582989516,"name":"02月份盘点","number":400,"total":"4800.00","inventory_losses":"12.00","inventory_surplus":"20.00","check_person":"彭超超","completion_time":1586845250,"type":null,"created_at":"2020-02-29 15:18:39","updated_at":"2020-04-14 14:20:50"}}
     * @return_param id int 盘点信息id
     * @return_param inventory_time int 盘点时间
     * @return_param name string 盘点名称
     * @return_param number string 盘点数量
     * @return_param total string 合计金额
     * @return_param inventory_losses int 盘亏
     * @return_param inventory_surplus int 盘盈
     * @return_param check_person string 盘点人
     * @return_param completion_time int 完成时间
     * @return_param type int 盘点完成状态(见备注)
     * @remark 盘点完成状态(0-未盘点1-已盘点)
     */
    public function detail($id)
    {
        return $this->_inventoryManagementService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 盘点数据列表
     * @description 盘点数据列表的接口
     * @method `get` `qurey_string`
     * @url   {{host}}/api/material-management/inventory-management/list
     * @return  {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":15,"inventory_time":1582989516,"name":"02月份盘点","number":400,"total":"4800.00","inventory_losses":"12.00","inventory_surplus":"20.00","check_person":"彭超超","completion_time":1586845250,"type":null,"created_at":"2020-02-29 15:18:39","updated_at":"2020-04-14 14:20:50"}],"first_page_url":"http://59.110.212.116:32801/api/material-management/inventory-management/list?page=1","from":1,"last_page":91,"last_page_url":"http://59.110.212.116:32801/api/material-management/inventory-management/list?page=91","next_page_url":"http://59.110.212.116:32801/api/material-management/inventory-management/list?page=2","path":"http://59.110.212.116:32801/api/material-management/inventory-management/list","per_page":"1","prev_page_url":null,"to":1,"total":91}}
     * @return_param id int 盘点信息id
     * @return_param inventory_time int 盘点时间
     * @return_param name string 盘点名称
     * @return_param number string 盘点数量
     * @return_param total string 合计金额
     * @return_param inventory_losses int 盘亏
     * @return_param inventory_surplus int 盘盈
     * @return_param check_person string 盘点人
     * @return_param completion_time json 完成时间
     * @return_param type int 盘点完成状态0-未盘点 1-已盘点
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
     * @remark 盘点完成状态(0-未盘点1-已盘点)
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_inventoryManagementService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 盘点数据删除
     * @description 盘点数据删除的接口
     * @method `delete`
     * @url   {{host}}/api/material-management/inventory-management/{id}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_inventoryManagementService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 盘点数据批量删除
     * @description 盘点数据批量删除的接口
     * @method `delete`
     * @param ids 必选 array 待删除数据项主键id数组
     * @url   {{host}}/api/material-management/inventory-management/
     * @json_param {"ids":[5,6,7]}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(InventoryManagementRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_inventoryManagementService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 生成上月盘点
     * @description 生成上月盘点的接口
     * @method `post`
     * @url   {{host}}/api/material-management/inventory-management/generate
     * @return  无
     */
    public function generate()
    {
        $this->_inventoryManagementService->generate();
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 盘点详情
     * @description 盘点详情的接口
     * @method `get`
     * @url   {{host}}/api/material-management/inventory-management/inventoryDetail/{id}
     * @json_param {id}为所要查询数据的主键id,添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":[{"warehouse_name":"华南A","operator_number":"RK202002292","operator":"彭超超","time":1581941905,"number":100,"price":12,"supplier":"飞利浦","name":"飞利浦","unit":0,"operator_type":"入库"}]}
     * @return_param warehouse_name int 仓库名称
     * @return_param operator_number string 库存单号
     * @return_param operator string 操作人
     * @return_param time string 时间
     * @return_param number int 数量
     * @return_param price int 价格
     * @return_param supplier string 供应商
     * @return_param name string 物资名称
     * @return_param unit int 单位(见备注)
     * @return_param operator_type int 盘点完成状态(见备注)
     * @remark 盘点完成状态(0-未盘点1-已盘点)单位(0-支 1-个 2-包)
     */
    public function inventoryDetail($id)
    {
        return $this->_inventoryManagementService->inventoryDetail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/盘点管理
     * @title 盘点搜索
     * @description 盘点搜索的接口
     * @method `post` `application/json`
     * @url  {{host}}/api/material-management/inventory-management/search
     * @param search_index 非必选 string 搜索字段(见备注)
     * @param content 非必选 string 搜索内容
     * @param time_range 非必选 int 时间范围(见备注)
     * @json_param {"content":"月","search_index":"name"}
     * @return {"status":200,"message":"操作成功","data":[{"id":15,"inventory_time":1582989516,"name":"02月份盘点","number":400,"total":"4800.00","inventory_losses":"12.00","inventory_surplus":"20.00","check_person":"彭超超","completion_time":1586845250,"type":null,"created_at":"2020-02-29 15:18:39","updated_at":"2020-04-14 14:20:50"}]}
     * @return_param id int 盘点信息id
     * @return_param inventory_time int 盘点时间
     * @return_param name string 盘点名称
     * @return_param number string 盘点数量
     * @return_param total string 合计金额
     * @return_param inventory_losses int 盘亏
     * @return_param inventory_surplus int 盘盈
     * @return_param check_person string 盘点人
     * @return_param completion_time int 完成时间
     * @return_param type int 盘点完成状态(见备注)
     * @remark 搜索字段(默认为：盘点名称-name盘点时间-inventory_time盘点人check_person)时间范围(默认为全部,例：一年以内：1，两年以内：2)盘点完成状态(0-未盘点1-已盘点)
     */
    public function search(InventoryManagementRequest $request)
    {
        $search_index   = $request->post('search_index') ?? 'name';
        $time_range     = (int)$request->post('time_range') ?? 'all';
        $content        = $request->post('content') ?? '';

        return $this->_inventoryManagementService->search($search_index,$time_range,$content);
    }
}