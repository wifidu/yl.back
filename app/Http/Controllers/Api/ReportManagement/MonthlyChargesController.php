<?php


namespace App\Http\Controllers\Api\ReportManagement;

use App\Http\Service\ReportManagement\MonthlyChargesService;
use App\Http\Requests\Api\ReportManagement\MonthlyChargesRequest;
use Dingo\Api\Contract\Http\Request;

class MonthlyChargesController
{
    private $_monthlyChargesService;

    public function __construct(monthlyChargesService $monthlyChargesService)
    {
        $this->_monthlyChargesService = $monthlyChargesService;
    }

    public function detail($id)
    {
        return $this->_monthlyChargesService->detail($id);
    }

    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_monthlyChargesService->list($page, $page_size);
    }

    public function delete($id)
    {
        return $this->_monthlyChargesService->delete($id);
    }

    public function batchDelete(monthlyChargesRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_monthlyChargesService->batchDelete($ids);
    }

    public function search(monthlyChargesRequest $request)
    {
        // DAY MONTH YEAR
        $time_type   = $request->post('time_type') ?? 'month';
        $time_range  = $request->post('time_range') ?? '';

        return $this->_monthlyChargesService->search((string)$time_type,(string)$time_range);
    }

    public function excelExport()
    {
        return $this->_monthlyChargesService->excelExport();
    }
}