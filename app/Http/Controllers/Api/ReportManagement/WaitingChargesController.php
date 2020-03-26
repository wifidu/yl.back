<?php


namespace App\Http\Controllers\Api\ReportManagement;

use App\Http\Service\ReportManagement\WaitingChargesService;
use App\Http\Requests\Api\ReportManagement\WaitingChargesRequest;
use Dingo\Api\Contract\Http\Request;

class WaitingChargesController
{
    private $_waitingChargesService;

    public function __construct(WaitingChargesService $waitingChargesService)
    {
        $this->_waitingChargesService = $waitingChargesService;
    }

    public function detail($id)
    {
        return $this->_waitingChargesService->detail($id);
    }

    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_waitingChargesService->list($page, $page_size);
    }

    public function delete($id)
    {
        return $this->_waitingChargesService->delete($id);
    }

    public function batchDelete(WaitingChargesRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_waitingChargesService->batchDelete($ids);
    }

    public function search(WaitingChargesRequest $request)
    {
        $search_index   = $request->post('search_index') ?? 'member_name';
        $content        = $request->post('content') ?? '';

        return $this->_waitingChargesService->search((string)$search_index,(string)$content);
    }

    public function excelExport()
    {
        return $this->_waitingChargesService->excelExport();
    }

    public function receiptOrRefund(WaitingChargesRequest $chargesRequest)
    {
        $params = $chargesRequest->post();
        $id     = $params['id'];
        $amount = $params['amount'];
        $time   = time();
        return $this->_waitingChargesService->receiptOrRefund($id,$amount,$time);
    }
}