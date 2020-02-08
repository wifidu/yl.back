<?php
namespace App\Http\Service\FinancialManagement;

use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use App\Http\Repository\FinancialManagement\RefundRespository;
use Illuminate\Support\Facades\Request;

class RefundService
{
    use ApiTraits;
    protected $refundRespository;

    public function __construct(RefundRespository $refundRespository)
    {
        $this->refundRespository = $refundRespository;
    }

    public function show($page, $page_size)
    {
        $refunds = $this->refundRespository->show($page, $page_size);

        // 格式化数据
        
        $refunds = $this->formatting($refunds);

        return $this->apiReturn($refunds, CodeEnum::SUCCESS);
    }

    public function showWithType($type, $page, $page_size)
    {
        $refunds = $this->refundRespository->showWithType($type, $page, $page_size);

        // formatting

        $refunds = $this->formatting($refunds);

        return $this->apiReturn($refunds, CodeEnum::SUCCESS);
    }

    public function showWithStatus($status, $page, $page_size)
    {
        $refunds = $this->refundRespository->showWithStatus($status, $page, $page_size);

        // formatting
        $refunds = $this->formatting($refunds);

        return $refunds = $this->apiReturn($refunds, CodeEnum::SUCCESS);
    }

    public function showWithNo($no)
    {
        $refunds = $this->refundRespository->showWithNo($no);

        // formatting
        $refunds = $this->formatting($refunds);

        return $refunds = $this->apiReturn($refunds, CodeEnum::SUCCESS);
    }

    public function update($refund)
    {
        $refund = $this->formatting($refund, 0);
        $result = $this->refundRespository->update($refund);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;

        return $this->apiReturn(['refund_no' => $refund['refund_no']], $result);
    }

    public function store($refund)
    {
        $refund = $this->formatting($refund, 0);
        $result = $this->refundRespository->store($refund);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['refund_no' => $refund['refund_no']], $result);
    }

    public function destory($no)
    {
        $result = $this->refundRespository->destory($no);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['refund_no' => $no], $result);
    }

    public function formatting($refunds = [], $type = 1)
    {
      if ($type == 1){
        foreach ($refunds as $refund){
          $refund->business_time = Date('Y-m-d H:i:s', $refund->business_time);
          $refund->refund_date == null ? : $refund->refund_date = Date('Y-m-d H:i:s', $refund->refund_date);

          // 将数字转换为收费类型，0：变更收费、1：请假退费、2：押金退费、3：退院退费

          switch ($refund->refund_type)
          {
              case 0:
                $refund->refund_type = '变更收费';
                break;
              case 1:
                $refund->refund_type = '请假退费';
                break;
              case 2:
                $refund->refund_type = '押金退费';
                break;
              case 3:
                $refund->refund_type = '退院退费';
                break;
          }
        }
      }else{
          $refunds['business_time'] = strtotime($refunds['business_time']);
          $refunds['refund_date'] == null ? : $refunds['refund_date'] = strtotime($refunds['refund_date']);

          // 将数字转换为收费类型，0：变更收费、1：请假退费、2：押金退费、3：退院退费

          switch ($refunds['refund_type'])
          {
              case '变更收费':
                $refunds['refund_type'] = 0;
                break;
              case '请假退费':
                $refunds['refund_type'] = 1;
                break;
              case '押金退费':
                $refunds['refund_type'] = 2;
                break;
              case '退院退费':
                $refunds['refund_type'] = 3;
                break;
          }
      }

      return $refunds;
    }
}
?>
