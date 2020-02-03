<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CreditManagementService;

class CreditManagementController extends Controller
{
    protected $creditManagementService;

    public function __construct(CreditManagementService $creditManagementService)
    {
        $this->creditManagementService = $creditManagementService;
    }

    public function show()
    {
        $results = $this->creditManagementService->show();
        return $results;
    }

    // 根据收款类型返回收款单
    public function showWithType($type)
    {
        $credits = $this->creditManagementService->showWithType($type);
        return $credits;
    }

    // 根据收款单号返回收款单
    public function showWithVoucherNo($voucherNo)
    {
        $credit = $this->creditManagementService->showWithVoucherNo($voucherNo);
        return $credit;
    }
}
