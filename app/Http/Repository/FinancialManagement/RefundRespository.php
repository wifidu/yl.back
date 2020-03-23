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

    public function show($page, $page_size, $type = null, $status = null, $no = null)
    {
        $finder = $this->refund;
        if (isset($no))
            return $finder->where('refund_no', $no)
                          ->with('account')
                          ->get();
        if (isset($type))
            $finder = $finder->where('refund_type', $type);
        if (isset($status))
            $finder = $finder->where('refund_status', $status);
        return $finder->with('account')->paginate($page_size);
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
