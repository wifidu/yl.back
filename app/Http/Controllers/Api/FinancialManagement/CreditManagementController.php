<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Services\CreditManagementService;

class CreditManagementController extends Controller
{
    protected $creditManagementService;

    public function __construct(CreditManagementService $creditManagementService)
    {
        $this->creditManagementService = $creditManagementService;
    }

    public function show(Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 15;
        $results = $this->creditManagementService->show($page, $page_size);

        return $results;
    }

    // 根据收款类型返回收款单
    public function showWithType($type, Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 15;
        $credits = $this->creditManagementService->showWithType($type, $page, $page_size);

        return $credits;
    }

    // 根据收款单号返回收款单
    public function showWithVoucherNo($voucherNo)
    {
        $credit = $this->creditManagementService->showWithVoucherNo($voucherNo);

        return $credit;
    }

    // 根据是否已经收款查询
    public function showWithIfPay($ifPay, Request $request)
    {
        $page = $request->page ?? 1;
        $page_size = $request->page_size ?? 15;
        $credits = $this->creditManagementService->showWithIfPay($ifPay, $page, $page_size);

        return $credits;
    }

    public function store(Request $request)
    {
        $bill = $request->post();
        return $this->creditManagementService->store($bill);
    }


    public function destory($voucherNo)
    {
        return $this->creditManagementService->destory($voucherNo);
    }

    public function update(Request $request)
    {
        $bill = $request->post();
        return $this->creditManagementService->update($bill);
    }
}
