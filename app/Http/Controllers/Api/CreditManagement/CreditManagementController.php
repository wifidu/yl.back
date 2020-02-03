<?php

namespace App\Http\Controllers\Api\CreditManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\CreditManagement\CreditManagementService;

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

    // 根据是否已经收款查询
    public function showWithIfPay($ifPay)
    {
        $credits = $this->creditManagementService->showWithIfPay($ifPay);
        return $credits;
    }
}
