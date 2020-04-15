<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\FixedAssetsService;
use App\Http\Requests\Api\MaterialManagement\FixedAssetsRequest;
use Dingo\Api\Contract\Http\Request;
use App\Model\FixedAssets;

class FixedAssetsController
{
    private $_fixedAssetsService;

    public function __construct(FixedAssetsService $fixedAssetsService)
    {
        $this->_fixedAssetsService = $fixedAssetsService;
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 固定资产数据存储
     * @description 固定资产数据存储的接口
     * @method `post` `application/json`
     * @url {{host}}/api/material-management/fixed-assets/
     * @param name 必选 string 物资名称
     * @param classification 必选 string 分类
     * @param type 必选 string 状态(见备注)
     * @param install_date 必选 string 安装时间
     * @json_param {"name":"LED台灯","classification":"家电耗材","type":1,"install_date":1583068101}
     * @return  {"status":200,"message":"操作成功","data":{"id":{"name":"LED台灯1","classification":"家电耗材1","type":1,"install_date":1583068101,"updated_at":"2020-04-13 11:33:22","created_at":"2020-04-13 11:33:22","id":3}}}
     * @return_param id int 固定资产id
     * @return_param name string 物资名称
     * @return_param classification string 分类
     * @return_param type int 状态(0-已损坏 1-在用 2-维修中)
     * @return_param install_date int 安装时间
     * @remark 状态(0-已损坏 1-在用 2-维修中),涉及到时间都采用10为时间戳，需要显示自行转换
     */
    public function store(FixedAssetsRequest $request)
    {
        $params = $request->post();
        return $this->_fixedAssetsService->store($params);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 固定资产详情
     * @description 固定资产详情的接口
     * @method `get`
     * @url  {{host}}/api/material-management/fixed-assets/{id}
     * @json_param {id}为所要查询数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":{"id":2,"name":"LED台灯","classification":"家电耗材","serial_number":null,"brand":null,"position":null,"model":null,"department":null,"administrators":null,"price":null,"type":1,"install_date":1583068101,"warranty":null,"remarks":null,"picture_url":null,"created_at":"2020-03-01 14:21:47","updated_at":"2020-03-01 14:21:47"}}
     * @return_param id int 固定资产id
     * @return_param name string 物资名称
     * @return_param classification string 分类
     * @return_param type int 状态(见备注)
     * @return_param install_date int 安装时间
     * @return_param serial_number string 序列号
     * @return_param brand string 品牌
     * @return_param position string 位置
     * @return_param model string 型号
     * @return_param department string 负责部门
     * @return_param administrators string 负责人
     * @return_param price string 金额
     * @return_param warranty int 保修期
     * @return_param remarks string 备注
     * @return_param picture_url string 图片URL
     * @remark 状态(0-已损坏 1-在用 2-维修中),涉及到时间都采用10为时间戳，需要显示自行转换
     */
    public function detail($id)
    {
        return $this->_fixedAssetsService->detail($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 固定资产列表
     * @description 固定资产列表的接口
     * @method `get` `query_string`
     * @param page 非必选 string 当前页数(默认为1)
     * @param page_size 非必选 string 页面大小(默认为20)
     * @url   {{host}}/api/material-management/fixed-assets/list?page=1&page_size=1
     * @json_param 参数以query_string的形式连接在url后
     * @return  {"status":200,"message":"操作成功","data":{"current_page":1,"data":[{"id":2,"name":"LED台灯","classification":"家电耗材","serial_number":null,"brand":null,"position":null,"model":null,"department":null,"administrators":null,"price":null,"type":1,"install_date":1583068101,"warranty":null,"remarks":null,"picture_url":null,"created_at":"2020-03-01 14:21:47","updated_at":"2020-03-01 14:21:47"}],"first_page_url":"http://59.110.212.116:32801/api/material-management/fixed-assets/list?page=1","from":1,"last_page":2,"last_page_url":"http://59.110.212.116:32801/api/material-management/fixed-assets/list?page=2","next_page_url":"http://59.110.212.116:32801/api/material-management/fixed-assets/list?page=2","path":"http://59.110.212.116:32801/api/material-management/fixed-assets/list","per_page":"1","prev_page_url":null,"to":1,"total":2}}
     * @return_param id int 固定资产id
     * @return_param name string 物资名称
     * @return_param classification string 分类
     * @return_param type int 状态(见备注)
     * @return_param install_date int 安装时间
     * @return_param serial_number string 序列号
     * @return_param brand string 品牌
     * @return_param position string 位置
     * @return_param model string 型号
     * @return_param department string 负责部门
     * @return_param administrators string 负责人
     * @return_param price string 金额
     * @return_param warranty int 保修期
     * @return_param remarks string 备注
     * @return_param picture_url string 图片URL
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
     * @remark 状态(0-已损坏 1-在用 2-维修中),涉及到时间都采用10为时间戳，需要显示自行转换
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_fixedAssetsService->list($page, $page_size);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 固定资产删除
     * @description 固定资产删除的接口
     * @method `delete`
     * @url  {{host}}/api/material-management/fixed-assets/{id}
     * @json_param {id}为所要删除数据的主键id，添加在地址路由最后的{id}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function delete($id)
    {
        return $this->_fixedAssetsService->delete($id);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 固定资产批量删除
     * @description 固定资产批量删除的接口
     * @method `delete`
     * @param ids 必选 array 待删除数据项主键id数组
     * @url   {{host}}/api/material-management/fixed-assets/
     * @json_param {"ids":[5,6,7]}
     * @return  {"status":200,"message":"操作成功","data":""}
     */
    public function batchDelete(FixedAssetsRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_fixedAssetsService->batchDelete($ids);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 固定资产数据搜索
     * @description 固定资产数据搜索的接口
     * @method `post` `application/json`
     * @url {{host}}/api/material-management/fixed-assets/search
     * @param search_index 非必选 string 搜索字段(见备注)
     * @param content 非必选 string 搜索内容
     * @json_param {"search_index":"name","content":"LED台灯"}
     * @return  {"status":200,"message":"操作成功","data":[{"id":2,"name":"LED台灯","classification":"家电耗材","serial_number":null,"brand":null,"position":null,"model":null,"department":null,"administrators":null,"price":null,"type":1,"install_date":1583068101,"warranty":null,"remarks":null,"picture_url":null,"created_at":"2020-03-01 14:21:47","updated_at":"2020-03-01 14:21:47"}]}
     * @return_param id int 固定资产id
     * @return_param name string 物资名称
     * @return_param classification string 分类
     * @return_param type int 状态(见备注)
     * @return_param install_date int 安装时间
     * @return_param serial_number string 序列号
     * @return_param brand string 品牌
     * @return_param position string 位置
     * @return_param model string 型号
     * @return_param department string 负责部门
     * @return_param administrators string 负责人
     * @return_param price string 金额
     * @return_param warranty int 保修期
     * @return_param remarks string 备注
     * @return_param picture_url string 图片URL
     * @remark 状态(0-已损坏 1-在用 2-维修中),涉及到时间都采用10为时间戳，需要显示自行转换，搜索字段 包含(资产名称-name资产编号-serial_number分类-classification品牌-brand)
     */
    public function search(FixedAssetsRequest $request)
    {
        $search_index   = $request->post('search_index') ?? 'name';
        $content        = $request->post('content') ?? '';

        return $this->_fixedAssetsService->search($search_index,$content);
    }

    /**
     * showdoc
     * @catalog 接口文档/物资管理/固定资产
     * @title 自动生成资产编号
     * @description 自动生成资产编号的接口
     * @method `get`
     * @url  {{host}}/api/material-management/fixed-assets/assets_number
     * @json_param 无
     * @return {"status":200,"message":"操作成功","data":{"assets_number":6}}
     * @return_param assets_number int 资产编号
     */
    public function generateAssetsNumber()
    {
        return $this->_fixedAssetsService->generateAssetsNumber();
    }
}