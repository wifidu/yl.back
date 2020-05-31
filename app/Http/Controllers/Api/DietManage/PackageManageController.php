<?php


namespace App\Http\Controllers\Api\DietManage;

use App\Http\Service\DietManage\PackageManageService;
use App\Http\Requests\Api\DietManage\PackageManageRequest;
use Dingo\Api\Contract\Http\Request;


class PackageManageController
{
    private $_packageManageService;

    public function __construct(PackageManageService $PackageManageService)
    {
        $this->_packageManageService = $PackageManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据存储
     * @description 套餐数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/package-manage/
     * @param package_name 必选 string 套餐名称
     * @param package_price 必选 decimal 套餐价格
     * @param reserve_number 非必选 int 预定人数
     * @param package_describe 必选 string 套餐描述
     * @json_param {"package_name":"鱼香肉丝","package_price":"13","package_describe":"美味"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"package_name":"鱼香肉丝","package_price":"13","package_describe":"美味","updated_at":"2020-04-04 08:25:48","created_at":"2020-04-04 08:25:48","id":11}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据编辑
     * @description 套餐数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/package-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param package_name 必选 string 套餐名称
     * @param package_price 必选 decimal 套餐价格
     * @param reserve_number 非必选 int 预定人数
     * @param package_describe 必选 string 套餐描述
     * @json_param {"id":1,"package_name":"鱼香肉丝","package_price":"14","package_describe":"美味"}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":1,"package_name":"鱼香肉丝","package_price":"14","reserve_number":3,"package_describe":"美味","created_at":"2020-03-06 14:34:03","updated_at":"2020-04-04 09:37:26"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(PackageManageRequest $request)
    {
        $params = $request->post();
        return $this->_packageManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据详情
     * @description 套餐数据详情的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/package-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":{"id":11,"package_name":"鱼香肉丝","package_price":"13.00","reserve_number":0,"package_describe":"美味","created_at":"2020-04-04 08:25:48","updated_at":"2020-04-04 08:25:48"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_packageManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据删除
     * @description 套餐数据删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/package-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_packageManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据列表
     * @description 套餐数据列表的接口
     * @method `GET` `query_string`
     * @url {{host}}/api/diet-management/package-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":1,"package_name":"鱼香肉丝","package_price":"12.00","reserve_number":3,"package_describe":"美味","created_at":"2020-03-06 14:34:03","updated_at":"2020-03-06 15:21:51"}],"first_page_url":"http://59.110.212.116:32801/api/diet-manage/package-manage/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/diet-manage/package-manage/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/diet-manage/package-manage/list","per_page":20,"prev_page_url":null,"to":1,"total":1}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_packageManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据批量删除
     * @description 套餐数据批量删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/package-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(PackageManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_packageManageService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/套餐管理
     * @title 套餐数据配送
     * @description 套餐预定的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/package-manage/order/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function order($id)
    {
        return $this->_packageManageService->order($id);
    }
}
