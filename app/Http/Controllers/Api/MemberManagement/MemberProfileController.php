<?php


namespace App\Http\Controllers\Api\MemberManagement;


use App\Events\MemberProfile;
use App\Http\Controllers\Controller;
use App\Http\Service\MemberManagement\MemberProfileService;
use Dingo\Api\Contract\Http\Request;
use App\Http\Requests\Api\MemberManagement\MemberProfileRequests;

/**
 * Class MemberProfileController
 * @package App\Http\Controllers\Api\MemberProfile
 * @author YanJiGang
 */
class MemberProfileController extends Controller
{
    private $_memberProfile;
    public function __construct(MemberProfileService $memberProfileService)
    {
        $this->_memberProfile = $memberProfileService;
    }
    /**
     * 新增或修改会员信息
     * @param MemberProfileRequests $request
     * @return array
     */
    public function store(MemberProfileRequests $request)
    {
        $params = $request->post();
        return $this->_memberProfile->store($params);
    }
    /**
     * 会员详情
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        return $this->_memberProfile->detail($id);
    }

    /**
     * 分页显示会员名
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_memberProfile->list($page_size);
    }

    /**
     * 删除某会员
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->_memberProfile->delete($id);
    }

    /**
     * 搜索一个会员
     * @param MemberProfileRequests $request
     * @return array
     */
    public function search(MemberProfileRequests $request)
    {
        $params = $request->query();
        return $this->_memberProfile->search($params);
    }

}