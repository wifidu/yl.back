<?php


namespace App\Http\Controllers\Api\MemberManagement;

use App\Enum\CodeEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MemberManagement\BookBedRequests;
use App\Http\Service\MemberManagement\BookBedService;
use App\Jobs\Appointment;
use App\Traits\ApiTraits;
use Request;

class BookBedController extends Controller
{
    use ApiTraits;
    private $_bookBedService;
    public function __construct(BookBedService $bookBedService)
    {
        $this->_bookBedService = $bookBedService;
    }

    /**
     * 新增或修改订单信息
     * @param BookBedRequests $request
     * @return array
     */
    public function store(BookBedRequests $request)
    {
        $params = $request->post();
        dispatch(new Appointment($params, config('app.order_ttl')));
        return $this->apiReturn($params,CodeEnum::SUCCESS);
        // return $this->_bookBedService->store($params);
    }
    /**
     * 预约订单详情
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        return $this->_bookBedService->detail($id);
    }

    /**
     * 分页显示订单
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_bookBedService->list($page_size);
    }

    /**
     * 取消某订单
     * @param $id
     * @return array
     */
    public function cancel($id)
    {
        return $this->_bookBedService->cancel($id);
    }

    /**
     * 搜索一个预约订单
     * @param BookBedRequests $request
     * @return array
     */
    public function search(BookBedRequests $request)
    {
        $params = $request->query();
        return $this->_bookBedService->search($params);
    }

    /**
     * function 固定资产数据批量删除
     * describe 固定资产数据批量删除
     * @param BookBedRequests $request
     * @return array
     */
    public function batchDelete(BookBedRequests $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_bookBedService->batchDelete($ids);
    }
}
