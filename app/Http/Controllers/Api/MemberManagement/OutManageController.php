<?php


namespace App\Http\Controllers\Api\MemberManagement;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MemberManagement\CheckInManageRequest;
use App\Http\Requests\Api\MemberManagement\OutManageRequest;
use App\Http\Service\MemberManagement\OutManageService;
use Dingo\Api\Http\Request;

class OutManageController extends Controller
{
    private $_outMange;
    public function __construct(OutManageService $outMangeService)
    {
        $this->_outMange = $outMangeService;
    }

    /**
     * 新增或修改入住登记相关信息
     * @param OutManageRequest $request
     * @return array
     */
    public function store(OutManageRequest $request)
    {
        $params = $request->post();
        return $this->_outMange->store($params);
    }
    /**
     * 入住登记详情
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        return $this->_outMange->detail($id);
    }

    /**
     * 分页显示入住登记
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_outMange->list($page_size);
    }

    /**
     * 删除入住登记记录
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->_outMange->delete($id);
    }

    /**
     * 搜索一个入住登记
     * @param CheckInManageRequest $request
     * @return array
     */
    public function search(CheckInManageRequest $request)
    {
        $params = $request->get('member_name');
        return $this->_outMange->search($params);
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
        return $this->_outMange->batchDelete($ids);
    }

}