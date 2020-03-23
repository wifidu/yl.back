<?php


namespace App\Http\Controllers\Api\MemberManagement;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MemberManagement\CheckInManageRequest;
use App\Http\Requests\Api\MemberManagement\DeathRegistrationRequests;
use App\Http\Requests\Api\MemberManagement\OutManageRequest;
use App\Http\Service\MemberManagement\DeathRegistrationService;
use App\Http\Service\MemberManagement\OutManageService;
use Dingo\Api\Http\Request;

class DeathRegistrationController extends Controller
{
    private $_deathRegistration;
    public function __construct(DeathRegistrationService $deathRegistrationService)
    {
        $this->_deathRegistration = $deathRegistrationService;
    }

    /**
     * 新增或修改入住登记相关信息
     * @param DeathRegistrationRequests $request
     * @return array
     */
    public function store(DeathRegistrationRequests $request)
    {
        $params = $request->post();
        return $this->_deathRegistration->store($params);
    }
    /**
     * 入住登记详情
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        return $this->_deathRegistration->detail($id);
    }

    /**
     * 分页显示入住登记
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_deathRegistration->list($page_size);
    }

    /**
     * 删除入住登记记录
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->_deathRegistration->delete($id);
    }

    /**
     * 搜索一个入住登记
     * @param DeathRegistrationRequests $request
     * @return array
     */
    public function search(DeathRegistrationRequests $request)
    {
        $params = $request->get('member_name');
        return $this->_deathRegistration->search($params);
    }

    /**
     * 批量删除入住登记表
     * @param DeathRegistrationRequests $request
     * @return array
     */
    public function batchDelete(DeathRegistrationRequests $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_deathRegistration->batchDelete($ids);
    }
}