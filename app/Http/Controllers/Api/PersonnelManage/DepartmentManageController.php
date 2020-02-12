<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Http\Service\PersonnelManage\DepartmentManageService;
use App\Http\Requests\Api\PersonnelManage\DepartmentManageRequest;
use Dingo\Api\Contract\Http\Request;


class DepartmentManageController
{
    private $_departmentManageService;

    public function __construct(DepartmentManageService $DepartmentManageService)
    {
        $this->_departmentManageService = $DepartmentManageService;
    }

    /**
     * function 新增、编辑部门信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param DepartmentManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-2-5 15:30
     */
    public function store(DepartmentManageRequest $request)
    {
        $params = $request->post();
        return $this->_departmentManageService->store($params);
    }

    /**
     * function 部门详情
     * describe 查看部门信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-5 15:45
     */
    public function detail($id)
    {
        return $this->_departmentManageService->detail($id);
    }

    /**
     * function 部门删除
     * describe 删除部门信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-5 15:46
     */
    public function delete($id)
    {
        return $this->_departmentManageService->delete($id);
    }

    /**
     * function 部门数据列表
     * describe 部门数据列表
     * @param Request $request
     * @return mixed
     * @author kfccPeng
     * 2020-2-5 16:26
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_departmentManageService->list($page, $page_size);
    }

    /**
     * function 部门数据批量删除
     * describe 部门数据批量删除
     * @param FixedAssetsRequest $request
     * @return mixed
     * @author kfccPeng
     * 2020-2-5 16:26
     */
    public function batchDelete(DepartmentManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_departmentManageService->batchDelete($ids);
    }
}
