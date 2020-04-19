<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\WareHouseLogService;
use App\Http\Requests\Api\MaterialManagement\WareHouseLogRequest;
use Dingo\Api\Contract\Http\Request;

class WareHouseLogController
{
    private $_wareHouseLogService;

    public function __construct(WareHouseLogService $wareHouseLogService)
    {
        $this->_wareHouseLogService = $wareHouseLogService;
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/仓库日志
     * @title 数据详情
     * @description 数据详情的接口
     * @method `get`
     * @url   {{host}}/api/material-management/warehouse-log/{id}
     * @json_param {id}为所要查询数据的主键id,添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":{"id":1,"odd_number":"CK20200302","type":1,"warehouse_name":"华南AB","material_name":"飞利浦","brand":"飞利浦","supplier":"飞利浦","unit":0,"price":"13.00","number":100,"total":"1300.00","operator":"彭超超","operator_time":1583402054,"created_at":"2020-03-05 09:53:00","updated_at":"2020-03-05 09:54:15"}}
     * @return_param id int 仓库日志id
     * @return_param odd_number int 单号
     * @return_param type int 类操作型(见备注)
     * @return_param warehouse_name string 仓库名称
     * @return_param material_name string 物资名称
     * @return_param material_id string 物资id
     * @return_param brand string 品牌
     * @return_param supplier string 供应商
     * @return_param unit int 单位(见备注)
     * @return_param price string 价格
     * @return_param number int 数量
     * @return_param total string 总计金额
     * @return_param operator int 操作人
     * @return_param operator_time int 操作时间
     * @remark 类型(0-盘点 1-出库 2-入库)，单位(0-支 1-个 2-包)
     */
    public function detail($id)
    {
        return $this->_wareHouseLogService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/仓库日志
     * @title 数据列表
     * @description 数据列表的接口
     * @method `get` `query_string`
     * @url   {{{host}}/api/material-management/warehouse-log/list
     * @param page 非必选 当前页数
     * @param page_size 非必选 页面大小
     * @json_param 参数以query_string的形式连接在url后，例：{{host}}/api/material-management/warehouse-log/list?page=10&page_size=1
     * @return  {"status":200,"message":"操作成功","data":{"current_page":10,"data":[{"id":16,"odd_number":"RK20200229","type":2,"warehouse_name":"华南A","material_name":"飞利浦","brand":"飞利浦","supplier":"飞利浦","unit":0,"price":"12.00","number":100,"total":"1200.00","operator":"彭超超","operator_time":1583420700,"created_at":"2020-03-05 15:05:00","updated_at":"2020-03-05 15:05:00"}],"first_page_url":"http://59.110.212.116:32801/api/material-management/warehouse-log/list?page=1","from":10,"last_page":274,"last_page_url":"http://59.110.212.116:32801/api/material-management/warehouse-log/list?page=274","next_page_url":"http://59.110.212.116:32801/api/material-management/warehouse-log/list?page=11","path":"http://59.110.212.116:32801/api/material-management/warehouse-log/list","per_page":"1","prev_page_url":"http://59.110.212.116:32801/api/material-management/warehouse-log/list?page=9","to":10,"total":274}}
     * @return_param id int 仓库日志id
     * @return_param odd_number int 单号
     * @return_param type int 类操作型(见备注)
     * @return_param warehouse_name string 仓库名称
     * @return_param material_name string 物资名称
     * @return_param material_id string 物资id
     * @return_param brand string 品牌
     * @return_param supplier string 供应商
     * @return_param unit int 单位(见备注)
     * @return_param price string 价格
     * @return_param number int 数量
     * @return_param total string 总计金额
     * @return_param operator int 操作人
     * @return_param operator_time int 操作时间
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
     * @remark 类型(0-盘点 1-出库 2-入库)，单位(0-支 1-个 2-包)
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_wareHouseLogService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/仓库日志
     * @title 数据批量删除
     * @description 数据批量删除的接口
     * @method `delete`
     * @url   {{host}}/api/material-management/warehouse-log/{{id}}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_wareHouseLogService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/仓库日志
     * @title 数据批量删除
     * @description 数据批量删除的接口
     * @method `delete`
     * @param ids 必选 array 待删除数据项主键id数组
     * @url   {{host}}/api/material-management/warehouse-log/
     * @json_param {"ids":[5,6,7]}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(WareHouseLogRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_wareHouseLogService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/仓库日志
     * @title 搜索
     * @description 搜索的接口
     * @method `post` `application/json`
     * @url  {{host}}/api/material-management/inventory-management/search
     * @param search_index 非必选 string 搜索字段(见备注)
     * @param content 非必选 string 搜索内容
     * @param time_range 非必选 int 时间范围(见备注)
     * @param operator_type 非必选 int 操作方式(见备注)
     * @param warehouse_name 非必选 string 仓库名称
     * @json_param {"operator_type":1,"warehouse_name":"华南A","time_range":1}
     * @return {"status":200,"message":"操作成功","data":[{"id":2,"odd_number":"CK20200302","type":1,"warehouse_name":"华南A","material_name":"飞利浦","brand":"飞利浦","supplier":"飞利浦","unit":0,"price":"13.00","number":100,"total":"1300.00","operator":"彭超超","operator_time":1583402086,"created_at":"2020-03-05 09:54:46","updated_at":"2020-03-05 09:54:46"}]}
     * @return_param id int 仓库日志id
     * @return_param odd_number int 单号
     * @return_param type int 类操作型(见备注)
     * @return_param warehouse_name string 仓库名称
     * @return_param material_name string 物资名称
     * @return_param material_id string 物资id
     * @return_param brand string 品牌
     * @return_param supplier string 供应商
     * @return_param unit int 单位(见备注)
     * @return_param price string 价格
     * @return_param number int 数量
     * @return_param total string 总计金额
     * @return_param operator int 操作人
     * @return_param operator_time int 操作时间
     * @remark 搜索字段(默认为：盘点名称-name盘点时间-inventory_time盘点人check_person)时间范围(默认为全部,例：一年以内：1，两年以内：2)盘点完成状态(0-未盘点1-已盘点)操作方式(0-盘点1-出库2-入库)
     */
    public function search(WareHouseLogRequest $request)
    {
        $search_index   = $request->post('search_index') ?? 'odd_number';
        $time_range     = $request->post('time_range') ?? 'all';
        $operator_type  = $request->post('operator_type') ?? 'all';
        $warehouse_name = $request->post('warehouse_name') ?? 'all';
        $content        = $request->post('content') ?? '';

        return $this->_wareHouseLogService->search((string)$search_index,(string)$time_range,(string)$operator_type,(string)$warehouse_name,(string)$content);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/仓库日志
     * @title 导出EXCEL
     * @description 导出EXCEL的接口
     * @method `get`
     * @url   {{host}}/api/material-management/warehouse-log/excel
     * @json_param 无
     * @return  一个excel文件
     */
    public function excelExport()
    {
        return $this->_wareHouseLogService->excelExport();
    }
}