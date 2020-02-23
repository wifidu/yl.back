<?php


namespace App\Http\Controllers\Api\PersonnelManage;

use App\Http\Service\PersonnelManage\TeamManageService;
use App\Http\Requests\Api\PersonnelManage\TeamManageRequest;
use Dingo\Api\Contract\Http\Request;


class TeamManageController
{
    private $_teamManageService;

    public function __construct(TeamManageService $TeamManageService)
    {
        $this->_teamManageService = $TeamManageService;
    }

    /**
     * function 新增、编辑团队信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param TeamManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:56
     */
    public function store(TeamManageRequest $request)
    {
        $params = $request->post();
        return $this->_teamManageService->store($params);
    }

    /**
     * function 团队详情
     * describe 查看团队信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:57
     */
    public function detail($id)
    {
        return $this->_teamManageService->detail($id);
    }

    /**
     * function 团队删除
     * describe 团队删除
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:57
     */
    public function delete($id)
    {
        return $this->_teamManageService->delete($id);
    }

    /**
     * function 团队数据列表
     * describe 团队数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:58
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_teamManageService->list($page, $page_size);
    }

    /**
     * function 员工数据批量删除
     * describe 员工数据批量删除
     * @param TeamManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:58
     */
    public function batchDelete(TeamManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_teamManageService->batchDelete($ids);
    }
}
