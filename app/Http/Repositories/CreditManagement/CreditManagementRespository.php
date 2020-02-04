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

    public function show($page, $page_size)
    {
        return $this->creditManagement->paginate($page_size);
    }

    // 根据收款类型进行分类，0入住收费，1变更收费
    public function showWithType($type, $page, $page_size)
    {
        return $this->creditManagement->where('payment_type', $type)->paginate($page_size);
    }

    // 根据收款单号进行查询
    public function showWithVoucherNo($voucherNo)
    {
        return $this->creditManagement->where('voucher_no', $voucherNo)->get();
    }

    // 根据是否已经收费进行查询
    public function showWithIfPay($ifPay, $page, $page_size)
    {
        return $this->creditManagement->where('if_pay', $ifPay)->paginate($page_size);
    }

    public function store($bill)
    {
        $this->creditManagement->fill($bill);
        return $this->creditManagement->save();
    }

    public function update($bill)
    {
        return $this->creditManagement
                    ->where('voucher_no', $bill['voucher_no'])
                    ->update($bill);
    }

    public function destory($VoucherNo)
    {
        return $this->creditManagement
                    ->where('voucher_no', $VoucherNo)
                    ->delete();
    }
}
