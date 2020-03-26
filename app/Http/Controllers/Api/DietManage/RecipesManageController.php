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
     * function 新增、编辑套餐信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param RecipesManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:43
     */
    public function store(RecipesManageRequest $request)
    {
        $params = $request->post();
        return $this->_recipesManageService->store($params);
    }

    /**
     * function 套餐详情
     * describe 查看套餐信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:44
     */
    public function detail($id)
    {
        return $this->_recipesManageService->detail($id);
    }

    /**
     * function 套餐删除
     * describe 删除套餐信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:44
     */
    public function delete($id)
    {
        return $this->_recipesManageService->delete($id);
    }

    /**
     * function 套餐数据列表
     * describe 套餐数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:44
     */
    public function list(Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_recipesManageService->list($page, $page_size);
    }

    /**
     * function 套餐数据批量删除
     * describe 套餐数据批量删除
     * @param RecipesManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:45
     */
    public function batchDelete(RecipesManageRequest $request)
    {
        $params = $request->all();
        $ids = $params['ids'];
        return $this->_recipesManageService->batchDelete($ids);
    }

}
