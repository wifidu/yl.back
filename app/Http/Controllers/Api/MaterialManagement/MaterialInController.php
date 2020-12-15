<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\MaterialInService;
use App\Http\Requests\Api\MaterialManagement\MaterialInRequest;
use Dingo\Api\Contract\Http\Request;

class MaterialInController
{
    private $_materialInService;

    public function __construct(MaterialInService $materialInService)
    {
        $this->_materialInService = $materialInService;
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资入库
     * @title 物资入库数据存储
     * @description 物资入库数据存储的接口
     * @method `post` `application/json`
     * @url {{host}}/api/material-management/material-in/
     * @param in_number 必选 string 入库单号(见备注)
     * @param warehouse_name 必选 string 仓库名称
     * @param origin 必选 string 来源
     * @param batch_number 必选 string 批号
     * @param in_time 必选 int 入库时间
     * @param operator 必选 string 操作人
     * @param remarks 必选 string 备注
     * @param material_id 必选 int 物资id
     * @param amount 必选 int 入库数量
     * @json_param {"in_number":"RK20200229","warehouse_name":"华南A","origin":"上海","batch_number":"asa123456","in_time":1581941906,"operator":"彭超超","remarks":"很专业","in_material":{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906}}
     * @return  {"status":200,"message":"操作成功","data":{"id":{"in_number":"RK20200229","warehouse_name":"华南A","origin":"上海","batch_number":"asa123456","in_time":1581941906,"operator":"彭超超","remarks":"很专业","in_material":"{\"material_id\":8,\"number\":100,\"price\":12,\"supplier\":\"飞利浦\",\"expiry_date\":1581942906}","updated_at":"2020-04-14 11:32:28","created_at":"2020-04-14 11:32:28","id":132}}}
     * @return_param id int 物资入库id
     * @return_param in_number string 入库单号
     * @return_param warehouse_name string 仓库名称
     * @return_param origin string 来源
     * @return_param batch_number string 批号
     * @return_param in_time int 入库时间
     * @return_param operator string 操作人
     * @return_param remarks string 备注
     * @return_param material_id int 物资id
     * @return_param amount int 入库数量
     * @remark 入库单号，通过获取入库单号接口获取,入库清单格式如下：{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906}
     */
    public function store(MaterialInRequest $request)
    {
        $params = $request->post();
        return $this->_materialInService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资入库
     * @title 物资入库数据详情
     * @description 物资入库数据详情的接口
     * @method `get`
     * @url  {{host}}/api/material-management/material-in/{id}
     * @json_param {id}为所要查询数据的主键id
     * @return  {"status":200,"message":"操作成功","data":{"id":1,"inventory_id":null,"in_number":"RK202002291","warehouse_name":"华南A","origin":"上海","batch_number":"asa123456","in_time":1581941906,"operator":"彭超超","remarks":"很专业","in_material":"{\"material_id\":8,\"number\":100,\"price\":12,\"supplier\":\"飞利浦\",\"expiry_date\":1581942906}","created_at":"2020-03-29 03:54:28","updated_at":"2020-02-29 03:54:28"}}
     * @return_param id int 物资入库id
     * @return_param in_number string 入库单号
     * @return_param inventory_id int 库存id
     * @return_param warehouse_name string 仓库名称
     * @return_param origin string 来源
     * @return_param batch_number string 批号
     * @return_param in_time int 入库时间
     * @return_param operator string 操作人
     * @return_param remarks string 备注
     * @return_param in_material json 入库清单
     * @return_param in_material.material_id int 物资id
     * @return_param in_material.number int 入库数量
     * @return_param in_material.price float 价格
     * @return_param in_material.supplier string 供应商
     * @return_param in_material.expiry_date int 有效期
     * @remark 入库清单格式如下：{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906};在结果返回中in_material为转义后的json格式,需要进行json_decode()编码
     */
    public function detail($id)
    {
        return $this->_materialInService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资入库
     * @title 物资入库数据列表
     * @description 物资入库数据列表的接口
     * @method `get` `query_string`
     * @url   {{host}}/api/material-management/material-in/list
     * @json_param 参数以query_string的形式连接在url后。例如：{{host}}/api/material-management/material-in/list?page=1&page_size=10
     * @return  {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":1,"inventory_id":null,"in_number":"RK202002291","warehouse_name":"华南A","origin":"上海","batch_number":"asa123456","in_time":1581941906,"operator":"彭超超","remarks":"很专业","in_material":"{\"material_id\":8,\"number\":100,\"price\":12,\"supplier\":\"飞利浦\",\"expiry_date\":1581942906}","created_at":"2020-03-29 03:54:28","updated_at":"2020-02-29 03:54:28"}],"first_page_url":"http://59.110.212.116:32801/api/material-management/material-in/list?page=1","from":1,"last_page":116,"last_page_url":"http://59.110.212.116:32801/api/material-management/material-in/list?page=116","next_page_url":"http://59.110.212.116:32801/api/material-management/material-in/list?page=2","path":"http://59.110.212.116:32801/api/material-management/material-in/list","per_page":"1","prev_page_url":null,"to":1,"total":116}}
     * @return_param id int 物资入库id
     * @return_param in_number string 入库单号
     * @return_param inventory_id int 库存id
     * @return_param warehouse_name string 仓库名称
     * @return_param origin string 来源
     * @return_param batch_number string 批号
     * @return_param in_time int 入库时间
     * @return_param operator string 操作人
     * @return_param remarks string 备注
     * @return_param in_material json 入库清单
     * @return_param in_material.material_id int 物资id
     * @return_param in_material.number int 入库数量
     * @return_param in_material.price float 价格
     * @return_param in_material.supplier string 供应商
     * @return_param in_material.expiry_date int 有效期
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
     * @remark 入库单号，通过获取入库单号接口获取,入库清单格式如下：{"material_id":8,"number":100,"price":12,"supplier":"飞利浦","expiry_date":1581942906};在结果返回中in_material为转义后的json格式,需要进行json_decode()编码
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_materialInService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资入库
     * @title 物资入库删除
     * @description 物资入库删除的接口
     * @method `delete`
     * @url  {{host}}/api/material-management/material-in/{id}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_materialInService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资入库
     * @title 物资入库批量删除
     * @description 物资入库批量删除的接口
     * @method `delete`
     * @param ids 必选 array 待删除数据项主键id数组
     * @url  {{host}}/api/material-management/material-in/
     * @json_param {"ids":[5,6,7]}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(MaterialInRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_materialInService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/物资入库
     * @title 物资入库单号获取
     * @description 物资入库单号获取的接口
     * @method `get`
     * @url  {{host}}/api/material-management/material-in/odd_number
     * @return {"status":200,"message":"操作成功","data":{"RKoddNumber":"RK202004141586836120"}}
     * @return_param RKoddNumber string 入库单号
     */
    public function RKoddNumber()
    {
        return $this->_materialInService->RKoddNumber();
    }
}
