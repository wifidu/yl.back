<?php


namespace App\Http\Controllers\Api\DietManage;

use App\Http\Service\DietManage\RecipesManageService;
use App\Http\Requests\Api\DietManage\RecipesManageRequest;
use Dingo\Api\Contract\Http\Request;


class RecipesManageController
{
    private $_recipesManageService;

    public function __construct(RecipesManageService $RecipesManageService)
    {
        $this->_recipesManageService = $RecipesManageService;
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/食谱管理
     * @title 食谱数据存储
     * @description 食谱数据存储的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/recipes-manage/
     * @param weekly 必选 string 周次
     * @param package_name 必选 string 套餐名称
     * @param package_detail 非必选 json 套餐详情
     * @json_param {"weekly":"第一周","package_name":"标准套餐","package_detail":{"周一早餐":"包子","周一午餐":"红烧肉","周一晚餐":"鱼香肉丝"}}
     * @return {"status":200,"message":"操作成功","data":{"id":{"weekly":"第一周","package_name":"标准套餐","package_detail":{"周一早餐":"包子","周一午餐":"红烧肉","周一晚餐":"鱼香肉丝"},"updated_at":"2020-04-04 08:40:41","created_at":"2020-04-04 08:40:41","id":10}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    /**
     * showdoc
     * @catalog 接口文档/膳食管理/食谱管理
     * @title 食谱数据编辑
     * @description 食谱数据编辑的接口
     * @method `POST`  `application/json`
     * @url {{host}}/api/diet-management/recipes-manage/
     * @param id 必选 int 需要编辑的主键id
     * @param weekly 必选 string 周次
     * @param package_name 必选 string 套餐名称
     * @param package_detail 非必选 json 套餐详情
     * @json_param {"id":5,"weekly":"第二周","package_name":"标准套餐","package_detail":{"周二早餐":"包子","周二午餐":"红烧肉","周二晚餐":"鱼香肉丝"}}
     * @return {"status":200,"message":"操作成功","data":{"id":{"id":5,"weekly":"第二周","package_name":"标准套餐","package_detail":{"周二早餐":"包子","周二午餐":"红烧肉","周二晚餐":"鱼香肉丝"},"created_at":"2020-03-13 13:41:58","updated_at":"2020-04-04 09:41:18"}}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function store(RecipesManageRequest $request)
    {
        $params = $request->post();
        return $this->_recipesManageService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/食谱管理
     * @title 食谱数据详情
     * @description 食谱数据详情的接口
     * @method `GET`
     * @url {{host}}/api/diet-management/recipes-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":{"id":3,"weekly":"第一周","package_name":"标准套餐","package_detail":{"周一午餐":"红烧肉","周一早餐":"包子","周一晚餐":"鱼香肉丝"},"created_at":"2020-03-13 13:41:52","updated_at":"2020-03-13 14:32:56"}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function detail($id)
    {
        return $this->_recipesManageService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/食谱管理
     * @title 食谱数据删除
     * @description 食谱数据删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/precipes-manage/{id}
     * @param id 必选 int 配送主键id
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function delete($id)
    {
        return $this->_recipesManageService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/食谱管理
     * @title 食谱数据列表
     * @description 食谱数据列表的接口
     * @method `GET` `query_string`
     * @url {{host}}/api/diet-management/recipes-manage/list
     * @param page 非必选 int 当前页数 默认为1
     * @param page_size 非必选 int 页面数据大小 默认为20
     * @return {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":3,"weekly":"第一周","package_name":"标准套餐","package_detail":"{\"周一午餐\": \"红烧肉\", \"周一早餐\": \"包子\", \"周一晚餐\": \"鱼香肉丝\"}","created_at":"2020-03-13 13:41:52","updated_at":"2020-03-13 14:32:56"},{"id":5,"weekly":"第一周","package_name":"标准套餐","package_detail":null,"created_at":"2020-03-13 13:41:58","updated_at":"2020-03-13 13:41:58"}],"first_page_url":"http://59.110.212.116:32801/api/diet-manage/recipes-manage/list?page=1","from":1,"last_page":1,"last_page_url":"http://59.110.212.116:32801/api/diet-manage/recipes-manage/list?page=1","next_page_url":null,"path":"http://59.110.212.116:32801/api/diet-manage/recipes-manage/list","per_page":20,"prev_page_url":null,"to":2,"total":2}}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function list(Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_recipesManageService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/膳食管理/食谱管理
     * @title 食谱数据批量删除
     * @description 食谱数据批量删除的接口
     * @method `DELETE`
     * @url {{host}}/api/diet-management/recipes-manage/
     * @param ids 必选 array 待删除数据项主键id数组
     * @return {"status":200,"message":"操作成功","data":""}
     * @return_param status int 响应码
     * @return_param message string 返回结果描述
     * @return_param data array 返回数据信息
     */
    public function batchDelete(RecipesManageRequest $request)
    {
        $params = $request->all();
        $ids = $params['ids'];
        return $this->_recipesManageService->batchDelete($ids);
    }

}
