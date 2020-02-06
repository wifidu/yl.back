<?php

/*
 * What php team is that is 'one thing, a team, work together'
 */

namespace App\Http\Service\FinancialManagement;

use App\Http\Repository\FinancialManagement\CreditManagementRespository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;

class CreditManagementService
{
    use ApiTraits;
    protected $creditManagementRespository;

    public function __construct(CreditManagementRespository $creditManagementRespository)
    {
        $this->creditManagementRespository = $creditManagementRespository;
    }

    // 将收款单全部返回
    public function show($page, $page_size)
    {
        $credits = $this->creditManagementRespository->show($page, $page_size);

        // 格式化数据
        $credits = $this->formatting($credits);

        return $this->apiReturn($credits, CodeEnum::SUCCESS);
    }

    // 根据收款类型返回收款单
    public function showWithType($type, $page, $page_size)
    {
        $credits = $this->creditManagementRespository->showWithType($type, $page, $page_size);

        $credits = $this->formatting($credits);

        return $this->apiReturn($credits, CodeEnum::SUCCESS);
    }

    // 根据收款单号返回收款单
    public function showWithVoucherNo($voucherNo)
    {
        $credit = $this->creditManagementRespository->showWithVoucherNo($voucherNo);

        $credit = $this->formatting($credit);

        return $this->apiReturn($credit, CodeEnum::SUCCESS);
    }

    // 根据是否已经收款查询
    public function showWithIfPay($ifPay, $page, $page_size)
    {
        $credits = $this->creditManagementRespository->showWithIfPay($ifPay, $page, $page_size);

        $credits = $this->formatting($credits);

        return $this->apiReturn($credits, CodeEnum::SUCCESS);
    }

    public function store($bill)
    {
        $bill = $this->formatting([], $bill, 0);
        $result = $this->creditManagementRespository->store($bill);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['voucher_no' => $bill['voucher_no']], $result);
    }

    public function update($bill)
    {
        $bill = $this->formatting([], $bill, 0);
        $result = $this->creditManagementRespository->update($bill);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['voucher_no' => $bill['voucher_no']], $result);
    }


    public function destory($voucherNo)
    {
        $result = $this->creditManagementRespository->destory($voucherNo);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['voucher_no' => $voucherNo], $result);
    }
    // 数据格式化函数
    public function formatting($credits = [], $bill =[], $type = 1)
    {
      if($type ==1){
            foreach ($credits as $credit) {
                // 将时间戳转化为时间
                $credit->business_time = date('Y-m-d H:i:s', $credit->business_time);
                $credit->billing_date  = date('Y-m-d H:i:s', $credit->billing_date);

                // 将0/1 转换为退费类型
                $credit->payment_type = 1 == $credit->payment_type ? '变更收费' : '入住收费';
            }
          return $credits;
      }else{
          $bill['business_time'] = strtotime( $bill['business_time'] );
          $bill['billing_date'] = strtotime( $bill['billing_date'] );
          $bill['payment_type'] = $bill['payment_type'] == '变更收费' ? 1 : 0 ;
          return $bill;
      }
    }
}
