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
     * function 新增、编辑单品信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param FoodManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:49
     */
    public function store(FoodManageRequest $request)
    {
        $params = $request->post();
        return $this->_foodManageService->store($params);
    }

    /**
     * function 单品详情
     * describe 查看单品信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:50
     */
    public function detail($id)
    {
        return $this->_foodManageService->detail($id);
    }

    /**
     * function 单品删除
     * describe 删除单品信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:50
     */
    public function delete($id)
    {
        return $this->_foodManageService->delete($id);
    }

    /**
     * function 单品数据列表
     * describe 单品数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:50
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_foodManageService->list($page, $page_size);
    }

    /**
     * function 单品数据批量删除
     * describe 单品数据批量删除
     * @param FoodManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:51
     */
    public function batchDelete(FoodManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_foodManageService->batchDelete($ids);
    }

    /**
     * function 改变单品状态
     * describe 改变单品状态
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-01 19:16
     */
    public function typeChange($id)
    {
        return $this->_foodManageService->typeChange($id);
    }
}
