<?php


namespace App\Http\Controllers\Api\DietManage;

use App\Http\Service\DietManage\DeliveryManageService;
use App\Http\Requests\Api\DietManage\DeliveryManageRequest;
use Dingo\Api\Contract\Http\Request;


class DeliveryManageController
{
    private $_deliveryManageService;

    public function __construct(DeliveryManageService $DeliveryManageService)
    {
        $this->_deliveryManageService = $DeliveryManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据存储
     * @description 配送数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/delivery-manage/
     * @param member_name 必选 string 会员名称
     * @param bed_name 必选 string 床位名称
     * @param eat_time 必选 int 就餐时间
     * @param meal_times 必选 string 餐次
     * @param dishes_name 必选 string 菜品名称
     * @param dining_style 必选 tinyint 就餐方式
     * @param type 必选 tinyint 状态
     * @json_param {"member_name":"张三","bed_name":"21#303","eat_time":1584869850,"meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":0,"type":1}
     * @return {"status":200,"message":"操作成功","data":{"id":{"member_name":"张三","bed_name":"21#303","eat_time":"1584869850","meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":"1","updated_at":"2020-04-04 08:50:37","created_at":"2020-04-04 08:50:37","id":13}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据编辑
     * @description 配送数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/delivery-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param member_name 必选 string 会员名称
     * @param bed_name 必选 string 床位名称
     * @param eat_time 必选 int 就餐时间
     * @param meal_times 必选 string 餐次
     * @param dishes_name 必选 string 菜品名称
     * @param dining_style 必选 tinyint 就餐方式
     * @param type 必选 tinyint 状态
     * @json_param {"id":5,"member_name":"张三","bed_name":"21#303","eat_time":1584869850,"meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":0,"type":1}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":5,"member_name":"张三","bed_name":"21#303","eat_time":"1584869850","meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":"1","type":1,"created_at":"2020-03-22 09:37:57","updated_at":"2020-04-04 09:47:05"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(DeliveryManageRequest $request)
    {
        $params = $request->post();
        return $this->_deliveryManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据详情
     * @description 配送数据详情的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/delivery-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":{"id":13,"member_name":"张三","bed_name":"21#303","eat_time":1584869850,"meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":1,"type":0,"created_at":"2020-04-04 08:50:37","updated_at":"2020-04-04 08:50:37"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_deliveryManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据删除
     * @description 配送数据删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/delivery-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_deliveryManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据列表
     * @description 配送数据列表的接口
     * @method `GET` `query_string`
     * @url {{host}}/api/diet-management/delivery-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":1,"member_name":"张三","bed_name":"21#303","eat_time":1584869850,"meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":0,"type":0,"created_at":"2020-03-22 09:37:49","updated_at":"2020-03-22 09:37:49"},{"id":5,"member_name":"张三","bed_name":"21#303","eat_time":1584869850,"meal_times":"午餐","dishes_name":"西红柿炒鸡蛋","dining_style":0,"type":1,"created_at":"2020-03-22 09:37:57","updated_at":"2020-03-22 09:40:14"}],"first_page_url":"http://59.110.212.116:32801/api/diet-manage/delivery-manage/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/diet-manage/delivery-manage/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/diet-manage/delivery-manage/list","per_page":20,"prev_page_url":null,"to":2,"total":2}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_deliveryManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据批量删除
     * @description 配送数据批量删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/delivery-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(DeliveryManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_deliveryManageService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/配送管理
     * @title 配送数据配送
     * @description 配送数据配送的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/delivery-manage/delivery/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delivery($id)
    {
        return $this->_deliveryManageService->delivery($id);
    }
}
