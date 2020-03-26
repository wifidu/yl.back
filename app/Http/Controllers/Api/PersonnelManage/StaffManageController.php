<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Http\Service\PersonnelManage\StaffManageService;
use App\Http\Requests\Api\PersonnelManage\StaffManageRequest;
use Dingo\Api\Contract\Http\Request;


class StaffManageController
{
    private $_staffManageService;

    public function __construct(StaffManageService $StaffManageService)
    {
        $this->_staffManageService = $StaffManageService;
    }

     /**
      * function 新增,编辑员工信息
      * describe 新增的id自增，编辑中的数据中需要包含编辑的id
      * @param StaffManageRequest $request
      * @return array
      * @author kfccPeng
      * 2020-2-17 17:24
      */
    public function store(StaffManageRequest $request)
    {
        $params = $request->post();
        return $this->_staffManageService->store($params);
    }

    /**
     * function 员工详情
     * describe 查看员工信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:25
     */
    public function detail($id)
    {
        return $this->_staffManageService->detail($id);
    }

    /**
     * function 员工删除
     * describe 删除员工信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:25
     */
    public function delete($id)
    {
        return $this->_staffManageService->delete($id);
    }

    /**
     * function 员工数据列表
     * describe 员工数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:26
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_staffManageService->list($page, $page_size);
    }

    /**
     * function 员工数据批量删除
     * describe 员工数据批量删除
     * @param StaffManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:26
     */
    public function batchDelete(StaffManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_staffManageService->batchDelete($ids);
    }
}
