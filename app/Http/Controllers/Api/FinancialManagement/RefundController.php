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
        $results = $this->refundService->show($request->get('page', 1),
                                              $request->get('page_size', 15),
                                              $request->get('type', null),
                                              $request->get('status', null),
                                              $request->get('no', null));

        return $results;
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

    public function update(Request $request)
    {
        $refund = $request->all();
        return $this->refundService->update($refund);
    }
}
