<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Events\MaterialOut;
use App\Events\WarehouseLog;
use App\Http\Service\MaterialManagement\MaterialOutService;
use App\Http\Requests\Api\MaterialManagement\MaterialOutRequest;
use Dingo\Api\Contract\Http\Request;

class MaterialOutController
{
    private $_materialOutService;

    public function __construct(MaterialOutService $materialOutService)
    {
        $this->_materialOutService = $materialOutService;
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资出库
     * @title 物资出库数据存储
     * @description 物资出库数据存储的接口
     * @method `post` `application/json`
     * @url  {{host}}/api/material-management/material-out/
     * @param out_number 必选 string 出库单号(见备注)
     * @param warehouse_name 必选 string 仓库名称
     * @param whereabouts 必选 string 去向
     * @param user 必选 string 领用人
     * @param out_time 必选 int 出库时间
     * @param operator 必选 string 操作人
     * @param remarks 必选 string 备注
     * @param out_material 必选 json 入库清单
     * @param out_material.material_id 必选 int 物资id
     * @param out_material.number 必选 int 出库数量
     * @param out_material.price 必选 float 价格
     * @param out_material.supplier 必选 string 供应商
     * @param out_material.expiry_date 必选 int 有效期
     * @json_param {"out_number":"CK20200302","warehouse_name":"华南A","whereabouts":"上海","user":"asa123456","out_time":1581941906,"operator":"彭超超","remarks":"很专业","out_material":{"material_id":8,"number":100,"price":13,"supplier":"飞利浦","expiry_date":1581942906}}
     * @return  {"status":200,"message":"操作成功","data":{"id":{"out_number":"CK20200302","warehouse_name":"华南A","whereabouts":"上海","user":"asa123456","out_time":1581941906,"operator":"彭超超","remarks":"很专业","out_material":"{\"material_id\":8,\"number\":100,\"price\":13,\"supplier\":\"飞利浦\",\"expiry_date\":1581942906}","updated_at":"2020-04-14 11:52:11","created_at":"2020-04-14 11:52:11","id":16}}}
     * @return_param id int 物资出库id
     * @return_param out_number string 出库单号(见备注)
     * @return_param warehouse_name string 仓库名称
     * @return_param whereabouts string 去向
     * @return_param user string 领用人
     * @return_param out_time int 出库时间
     * @return_param operator string 操作人
     * @return_param remarks string 备注
     * @return_param out_material json 出库清单
     * @return_param out_material.material_id 必选 int 物资id
     * @return_param out_material.number 必选 int 出库数量
     * @return_param out_material.price 必选 float 价格
     * @return_param out_material.supplier 必选 string 供应商
     * @return_param out_material.expiry_date 必选 int 有效期
     * @remark 出库单号，通过获取出库单号接口获取,出库清单格式如下：{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906}
     */
    public function store(MaterialOutRequest $request)
    {
        $params = $request->post();
        event(new WarehouseLog($params));
        event(new MaterialOut($params));
        return $this->_materialOutService->store($params);
    }

     /**
     * showdoc
     * @catalog 接口文档/物资管理/物资出库
     * @title 物资出库数据详情
     * @description 物资出库数据详情的接口
     * @method `get`
     * @url  {{host}}/api/material-management/material-out/{id}
     * @json_param {id}为所要查询数据的主键id,添加在地址路由最后的{id}
     * @return {"status":200,"message":"操作成功","data":{"id":18,"inventory_id":null,"warehouse_name":"华南A","out_number":"CK20200302","whereabouts":"上海","user":"asa123456","out_time":1581941906,"operator":"彭超超","remarks":"很专业","out_material":"{\"material_id\":8,\"number\":100,\"price\":13,\"supplier\":\"飞利浦\",\"expiry_date\":1581942906}","created_at":"2020-04-14 11:52:22","updated_at":"2020-04-14 11:52:22"}}
      * @return_param id int 物资出库id
     * @return_param out_number string 出库单号
     * @return_param inventory_id int 库存id
     * @return_param warehouse_name string 仓库名称
     * @return_param whereabouts string 去向
     * @return_param user string 领用人
     * @return_param out_time int 出库时间
     * @return_param operator string 操作人
     * @return_param remarks string 备注
     * @return_param out_material json 出库清单
     * @return_param out_material.material_id int 物资id
     * @return_param out_material.number int 入库数量
     * @return_param out_material.price float 价格
     * @return_param out_material.supplier string 供应商
     * @return_param out_material.expiry_date int 有效期
     * @remark 出库清单格式如下：{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906};在结果返回中out_material为转义后的json格式,需要进行json_decode()编码
     */
    public function detail($id)
    {
        return $this->_materialOutService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资出库
     * @title 物资出库数据列表
     * @description 物资出库数据列表的接口
     * @method `get` `query_string`
     * @url   {{host}}/api/material-management/material-out/list
     * @json_param 参数以query_string的形式连接在url后。例如：{{host}}/api/material-management/material-out/list?page=1&page_size=10
     * @return  {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":2,"inventory_id":133,"warehouse_name":"华南A","out_number":"CK202002292","whereabouts":"上海","user":"asa123456","out_time":1581941903,"operator":"彭超超","remarks":"很专业","out_material":"{\"material_id\":8,\"number\":100,\"price\":12,\"supplier\":\"飞利浦\",\"expiry_date\":1581942906}","created_at":"2020-02-29 04:52:24","updated_at":"2020-03-05 10:54:13"}],"first_page_url":"http://59.110.212.116:32801/api/material-management/material-out/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/material-management/material-out/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/material-management/material-out/list","per_page":20,"prev_page_url":null,"to":17,"total":17}}
     * @return_param id int 物资出库id
     * @return_param out_number string 出库单号
     * @return_param warehouse_name string 仓库名称
     * @return_param whereabouts string 去向
     * @return_param user string 领用人
     * @return_param out_time int 出库时间
     * @return_param operator string 操作人
     * @return_param remarks string 备注
     * @return_param out_material json 出库清单
     * @return_param out_material.material_id 必选 int 物资id
     * @return_param out_material.number 必选 int 出库数量
     * @return_param out_material.price 必选 float 价格
     * @return_param out_material.supplier 必选 string 供应商
     * @return_param out_material.expiry_date 必选 int 有效期
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
     * @remark 出库清单格式如下：{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906};在结果返回中out_material为转义后的json格式,需要进行json_decode()编码
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_materialOutService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资出库
     * @title 物资出库删除
     * @description 物资出库删除的接口
     * @method `delete`
     * @url  {{host}}/api/material-management/material-out/{id}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_materialOutService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资出库
     * @title 物资出库批量删除
     * @description 物资出库批量删除的接口
     * @method `delete`
     * @param ids 必选 array 待删除数据项主键id数组
     * @url  {{host}}/api/material-management/material-out/
     * @json_param {"ids":[5,6,7]}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(MaterialOutRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_materialOutService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资出库
     * @title 物资出库单号获取
     * @description 物资出库单号获取的接口
     * @method `get`
     * @url  {{host}}/api/material-management/material-out/odd_number
     * @return {"status":200,"message":"操作成功","data":{"CKoddNumber":"CK202004141586837931"}}
     * @return_param CKoddNumber string 出库单号
     */
    public function CKoddNumber()
    {
        return $this->_materialOutService->CKoddNumber();
    }
}
