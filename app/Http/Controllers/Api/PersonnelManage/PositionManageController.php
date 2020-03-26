<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Events\PositionManage;
use App\Http\Service\PersonnelManage\PositionManageService;
use App\Http\Requests\Api\PersonnelManage\PositionManageRequest;
use Dingo\Api\Contract\Http\Request;


class PositionManageController
{
    private $_positionManageService;

    public function __construct(PositionManageService $PositionManageService)
    {
        $this->_positionManageService = $PositionManageService;
    }

    /**
     * function 新增、编辑职位信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param PositionManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:09
     */
    public function store(PositionManageRequest $request)
    {
        $params = $request->post();
        return $this->_positionManageService->store($params);
    }

    /**
     * function 职位详情
     * describe 查看职位信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:10
     */
    public function detail($id)
    {
        return $this->_positionManageService->detail($id);
    }

    /**
     * function 职位删除
     * describe 删除职位信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:11
     */
    public function delete($id)
    {
        return $this->_positionManageService->delete($id);
    }

    /**
     * function 职位数据列表
     * describe 职位数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:11
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_positionManageService->list($page, $page_size);
    }

    /**
     * function 职位数据批量删除
     * describe 职位数据批量删除
     * @param PositionManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:12
     */
    public function batchDelete(PositionManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_positionManageService->batchDelete($ids);
    }
}
