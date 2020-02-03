<?php
namespace app\Http\Services;

use App\Http\Respositories\CreditManagementRespository;

class CreditManagementService
{
    protected $creditManagementRespository;
    
    public function __construct(CreditManagementRespository $creditManagementRespository)
    {
        $this->creditManagementRespository = $creditManagementRespository;
    }

    public function show()
    {
        $credits = $this->creditManagementRespository->show();
        foreach($credits as $credit){
          // 将时间戳转化为时间
          $credit->business_time = date('Y-m-d H:i:s',$credit->business_time);
          $credit->billing_date = date('Y-m-d H:i:s', $credit->billing_date);

          // 将0/1 转换为退费类型
          $credit->payment_type = $credit->payment_type == 1 ? '变更收费' : '入住收费';
        }

        return $credits;
    }
}
?>
