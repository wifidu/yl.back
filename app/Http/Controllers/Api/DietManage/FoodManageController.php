<?php


namespace App\Http\Controllers\Api\DietManage;

use App\Http\Service\DietManage\FoodManageService;
use App\Http\Requests\Api\DietManage\FoodManageRequest;
use Dingo\Api\Contract\Http\Request;


class FoodManageController
{
    private $_foodManageService;

    public function __construct(FoodManageService $FoodManageService)
    {
        $this->_foodManageService = $FoodManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据存储
     * @description 单品数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/food-manage/
     * @param food_name 必选 string 单品名称
     * @param food_price 必选 decimal 单品价格
     * @param food_type 必选 tinyint 单品状态
     * @param subordinate_species 必选 string 所属类别
     * @json_param {"food_name":"土豆","food_price":"1","food_type":0,"subordinate_species":"蔬菜"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"food_name":"土豆","food_price":"1","food_type":"0","subordinate_species":"蔬菜","updated_at":"2020-04-04 08:12:43","created_at":"2020-04-04 08:12:43","id":7}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据编辑
     * @description 单品数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/food-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param food_name 必选 string 单品名称
     * @param food_price 必选 decimal 单品价格
     * @param food_type 必选 tinyint 单品状态
     * @param subordinate_species 必选 string 所属类别
     * @json_param {"id":6,"food_name":"土豆","food_price":"1","food_type":0,"subordinate_species":"蔬菜"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":6,"food_name":"土豆","food_price":"1","food_type":"0","subordinate_species":"蔬菜","created_at":"2020-02-29 10:40:26","updated_at":"2020-04-04 09:33:39"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(FoodManageRequest $request)
    {
        $params = $request->post();
        return $this->_foodManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据详情
     * @description 单品数据详情的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/food-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":{"id":1,"food_name":"土豆","food_price":"1.00","food_type":1,"subordinate_species":"蔬菜","created_at":"2020-02-29 10:40:02","updated_at":"2020-03-01 11:05:41"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_foodManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据删除
     * @description 单品数据删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/food-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_foodManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据列表
     * @description 单品数据列表的接口
     * @method `GET` `query_string`
     * @url {{host}}/api/diet-management/food-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":1,"food_name":"土豆","food_price":"1.00","food_type":1,"subordinate_species":"蔬菜","created_at":"2020-02-29 10:40:02","updated_at":"2020-03-01 11:05:41"},{"id":6,"food_name":"土豆","food_price":"1.50","food_type":0,"subordinate_species":"蔬菜","created_at":"2020-02-29 10:40:26","updated_at":"2020-02-29 10:40:26"}],"first_page_url":"http://59.110.212.116:32801/api/diet-manage/food-manage/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/diet-manage/food-manage/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/diet-manage/food-manage/list","per_page":20,"prev_page_url":null,"to":2,"total":2}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_foodManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据批量删除
     * @description 单品数据批量删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/food-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(FoodManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_foodManageService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/单品管理
     * @title 单品数据配送
     * @description 单品数据状态改变的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/food-manage/typeChange/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function typeChange($id)
    {
        return $this->_foodManageService->typeChange($id);
    }
}
