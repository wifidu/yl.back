<?php

namespace App\Http\Controllers\Api\FinancialManagement;

use Illuminate\Http\Request;
use App\Http\Requests\Api\FinancialManagement\RefundRequest;
use App\Http\Controllers\Controller;
use App\Http\Service\FinancialManagement\RefundService;

class RefundController extends Controller
{
    protected $refundService;

    public function __construct(RefundService $refundService)
    {
        $this->refundService = $refundService;
    }

    public function show(Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 15;
        $results = $this->refundService->show($page, $page_size);

        return $results;
    }

    public function showWithType($type, Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 15;
        $refunds = $this->refundService->showWithType($type, $page, $page_size);

        return $refunds;
    }

    public function showWithStatus($status, Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 15;
        $refunds = $this->refundService->showWithStatus($status, $page, $page_size);

        return $refunds;
    }

    public function showWithNo($no, Request $request)
    {
        return  $this->refundService->showWithNo($no);
    }

    public function store(RefundRequest $request)
    {
        $reufnd = $request->post();
        return $this->refundService->store($reufnd);
    }

    public function destory($no)
    {
        return $this->refundService->destory($no);
    }

    public function update(RefundRequest $request)
    {
        $refund = $request->all();
        return $this->refundService->update($refund);
    }
}
