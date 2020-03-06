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
     * function 新增、编辑套餐信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param PackageManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:12
     */
    public function store(PackageManageRequest $request)
    {
        $params = $request->post();
        return $this->_packageManageService->store($params);
    }

    /**
     * function 套餐详情
     * describe 查看套餐信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:13
     */
    public function detail($id)
    {
        return $this->_packageManageService->detail($id);
    }

    /**
     * function 套餐删除
     * describe 删除套餐信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:13
     */
    public function delete($id)
    {
        return $this->_packageManageService->delete($id);
    }

    /**
     * function 套餐数据列表
     * describe 套餐数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:13
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_packageManageService->list($page, $page_size);
    }

    /**
     * function 套餐数据批量删除
     * describe 套餐数据批量删除
     * @param PackageManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:14
     */
    public function batchDelete(PackageManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_packageManageService->batchDelete($ids);
    }

    /**
     * function 预定套餐
     * describe 预定套餐
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:14
     */
    public function order($id)
    {
        return $this->_packageManageService->order($id);
    }
}
