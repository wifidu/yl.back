<?php
namespace App\Http\Repository\FinancialManagement;

use App\Model\Account;

class AccountRespository
{
    protected $account;

    public function __construct(Account $account)
    {
        $this->account = $account;
    }

    public function show($page, $page_size)
    {
        return $this->account->paginate($page_size);
    }

    public function showWithNo($no, $page, $page_size)
    {
        return $this->account->where('account_number', $no)->get();
    }

    /**
     * function showDeposit
     * describe 查询用户押金
     * @param   $member_name, $page, $page_size
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-04 16:25:S
     */
    public function showDeposit($member_name = null, $page, $page_size)
    {
      $finder = $this->account->select('member_name', 'beds', 'cd_card', 'deposit');
      if (isset($member_name))
          return $finder->paginate($page_size);
      else 
          return $finder->where('member_name', $member_name)
                        ->get();
    }

    public function store($account)
    {
        return $this->account->fill($account)->save();
    }

    public function update($account)
    {
        return $this->account
                    ->where('id', $account['id'])
                    ->update($account);
    }

    public function destory($id)
    {
        return $this->account
                    ->where('account_number', $id)
                    ->delete();
    }

    public function updateBalance($id, $money)
    {
        $this->account = $this->account->find($id);
        $this->account->account_balance = $this->account->account_balance + $money;
        return $this->account->save();
    }
}
?>
