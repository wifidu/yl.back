<?php
namespace App\Http\Service\FinancialManagement;

use App\Http\Repository\FinancialManagement\AgencyRespository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;

class AgencyService{
    use ApiTraits;
    protected $agencyRespository;

    public function __construct(AgencyRespository $agencyRespository)
    {
        $this->agencyRespository = $agencyRespository;
    }

    /**
     * function show
     * describe 查询机构账户
     * @param   $page, $page_size, $business_number, $start_time, $end_time
     * @return  Array
     * @author  DuWeifan
     * date     2020-02-29 22:45:S
     */
    public function show($page, $page_size, $business_number, $start_time, $end_time)
    {
      $agency = $this->agencyRespository->show($page,
                                            $page_size,
                                            $business_number,
                                            $start_time,
                                            $end_time);
      $agency = $this->formatting($agency, 1);
      return $this->apiReturn($agency, CodeEnum::SUCCESS);
    }

    /**
     * function store
     * describe 增加机构账户
     * @param   $agency
     * @return  Array
     * @author  DuWeifan
     * date     2020-02-29 22:45:S
     */
    public function store($agency)
    {
        $result = $this->agencyRespository->store($agency);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['business_number' => $agency['business_number']], $result);
    }

    /**
     * function update
     * describe 更新机构账户
     * @param   $agency
     * @return  bool
     * @author  DuWeifan
     * date     2020-02-29 22:45:S
     */
    public function update($agency)
    {
        $result = $this->agencyRespository->update($agency);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['business_number' => $agency['business_number']], $result);
    }

 /**
     * function destory
     * describe 删除机构账户
     * @param   $business_number
     * @return  bool
     * @author  DuWeifan
     * date     2020-02-29 22:46:S
     */
    public function destory($business_number)
    {
        $result = $this->agencyRespository->destory($business_number);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['business_number' => $business_number], $result);
    }

    /**
     * function formatting
     * describe 格式化数据,0存，1取
     * @param   $agency, $type
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-01 14:10:S
     */
    public function formatting($agencies, $type)
    {
      if ($type == 1){
        foreach ($agencies as $agency){
          $agency['financial_type'] = $agency['financial_type'] == 0 ? '经营收费' : '退费';
          $agency['money_flow'] = $agency['money_flow'] == 0 ? '支出' : '收入';
          switch ($agency->payment_channel)
          {
              case 0:
                $agency->payment_channel = '现金';
                break;
              case 1:
                $agency->payment_channel = '刷卡';
                break;
              case 2:
                $agency->payment_channel = '转账';
                break;
              case 3:
                $agency->payment_channel = '微信';
                break;
              case 4:
                $agency->payment_channel = '支付宝';
                break;
          }
        }
      }
      return $agencies;
    }
}
?>
