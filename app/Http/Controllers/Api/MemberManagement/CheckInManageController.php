<?php


namespace App\Http\Controllers\Api\MemberManagement;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MemberManagement\CheckInManageRequest;
use App\Http\Service\MemberManagement\CheckInManageService;
use Request;

class CheckInManageController extends Controller
{
    private $_checkInManage;
    public function __construct(CheckInManageService $checkInManageService)
    {
        $this->_checkInManage = $checkInManageService;
    }

    /**
     * 新增或修改入住登记相关信息
     * @param CheckInManageRequest $request
     * @return array
     */
    public function store(CheckInManageRequest $request)
    {
        $params = $request->post();
        return $this->_checkInManage->store($params);
    }
    /**
     * 入住登记详情
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        return $this->_checkInManage->detail($id);
    }

    /**
     * 分页显示入住登记
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_checkInManage->list($page_size);
    }

    /**
     * 删除入住登记记录
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->_checkInManage->delete($id);
    }

    /**
     * 搜索一个入住登记
     * @param CheckInManageRequest $request
     * @return array
     */
    public function search(CheckInManageRequest $request)
    {
        $params = $request->get('member_name');
        return $this->_checkInManage->search($params);
    }

    /**
     * 批量删除入住登记表
     * @param CheckInManageRequest $request
     * @return array
     */
    public function batchDelete(CheckInManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_checkInManage->batchDelete($ids);
    }


    /**
     * 上传医疗报告处理
     * @param CheckInManageRequest $request
     * @return mixed
     */
    public function upload(CheckInManageRequest $request)
    {
        $file = $request->file('medical_report');
        $id = $request->get('id');

        return $this->_checkInManage->upload($id, $file);
    }

    /**
     * 膳食变更以及业务变更
     * @param CheckInManageRequest $request
     * @return array
     */
    public function change(CheckInManageRequest $request)
    {
        $params = $request->post();
        return $this->_checkInManage->change($params);
    }
}
