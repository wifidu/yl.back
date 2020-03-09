<?php
namespace App\Http\Repository\FinancialManagement;

use App\Model\Agency;

class AgencyRespository
{
  protected $agency;

  public function __construct(Agency $agency)
  {
      $this->agency = $agency;
  }

  /**
   * function show
   * describe 查询所有账户
   * @param   $page, $page_size, $business_number, $start_time, $end_time
   * @return  Array
   * @author  DuWeifan
   * date     2020-02-29 21:44:S
   */
  public function show($page, $page_size, $business_number = null, $start_time = null, $end_time = null)
  {
      $finder = $this->agency;
      if (isset($start_time))
          $finder = $finder->where('created_at', '>', $start_time);
      if (isset($end_time))
          $finder = $finder->where('created_at', '<', $end_time);
      if (isset($business_number))
          $finder = $finder->where('business_number', $business_number);
      $agencies = $finder->paginate($page_size);
      return $agencies;
  }

  /**
   * function store
   * describe 增加机构账户
   * @param   $agency
   * @return  bool
   * @author  DuWeifan
   * date     2020-02-29 22:22:S
   */
  public function store($agency)
  {
      return $this->agency->fill($agency)->save();
  }

  /**
   * function update
   * describe 更新机构账户
   * @param   $agency
   * @return  bool
   * @author  DuWeifan
   * date     2020-02-29 22:26:S
   */
  public function update($agency)
  {
      return $this->agency
                  ->where('business_number', $agency['business_number'])
                  ->update($agency);
  }

  /**
   * function destory
   * describe 删除机构账户
   * @param   $business_number
   * @return  bool
   * @author  DuWeifan
   * date     2020-02-29 22:34:S
   */
  public function destory($business_number)
  {
      return $this->agency
                  ->where('business_number', $business_number)
                  ->delete();
  }
}
?>
