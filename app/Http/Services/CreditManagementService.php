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

    // 将收款单全部返回
    public function show()
    {
        $credits = $this->creditManagementRespository->show();

        // 格式化数据
        $credits = $this->formatting($credits);

        return $credits;
    }

    // 根据收款类型返回收款单
    public function showWithType($type)
    {
        $credits = $this->creditManagementRespository->showWithType($type);

        $credits = $this->formatting($credits);

        return $credits;
    }

    // 根据收款单号返回收款单
    public function showWithVoucherNo($voucherNo)
    {
        $credit = $this->creditManagementRespository->showWithVoucherNo($voucherNo);

        $credit = $this->formatting($credit);

        return $credit;
    }

    // 数据格式化函数
    public function formatting($credits)
    {
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
