<?php
namespace App\Http\Repository\FinancialManagement;

use App\Model\Refund;

class RefundRespository
{
    protected $refund;

    public function __construct(Refund $refund)
    {
        $this->refund = $refund;
    }

    public function show($page, $page_size)
    {
        return $this->refund->paginate($page_size);
    }

    public function showWithType($type, $page, $page_size)
    {
        return $this->refund->where('refund_type', $type)->paginate($page_size);
    }

    public function showWithStatus($status, $page, $page_size)
    {
        return $this->refund
                    ->where('refund_status', $status)
                    ->paginate($page_size);
    }

    public function showWithNo($no)
    {
        return $this->refund
                    ->where('refund_no', $no)
                    ->get();
    }

    public function store($refund)
    {
        return $this->refund->fill($refund)->save();
    }

    public function update($refund)
    {
      return $this->refund
                  ->where('refund_no', $refund['refund_no'])
                  ->update($refund);
    }

    public function destory($refund_no)
    {
      return $this->refund
                  ->where('refund_no', $refund_no)
                  ->delete();
    }
}
?>
