<?php
namespace App\Http\Respositories;

use App\Models\CreditManagement;

class CreditManagementRespository
{
    protected $creditManagement;

    public function __construct(CreditManagement $CreditManagement)
    {
        $this->creditManagement = $CreditManagement;
    }

    public function save()
    {
        
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

}
?>
