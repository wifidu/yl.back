<?php

/*
 * What php team is that is 'one thing, a team, work together'
 */

namespace App\Http\Repositories\CreditManagement;

use App\Models\CreditManagement;

class CreditManagementRespository
{
    protected $creditManagement;

    public function __construct(CreditManagement $CreditManagement)
    {
        $this->creditManagement = $CreditManagement;
    }

    public function show()
    {
        return $this->creditManagement->all();
    }

    // 根据收款类型进行分类，0入住收费，1变更收费
    public function showWithType($type)
    {
        return $this->creditManagement->where('payment_type', $type)->get();
    }

    // 根据收款单号进行查询
    public function showWithVoucherNo($voucherNo)
    {
        return $this->creditManagement->where('voucher_no', $voucherNo)->get();
    }

    // 根据是否已经收费进行查询
    public function showWithIfPay($ifPay)
    {
        return $this->creditManagement->where('if_pay', $ifPay)->get();
    }
}
