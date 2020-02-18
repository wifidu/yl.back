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

    public function store($account)
    {
        return $this->account->fill($account)->save();
    }

    public function update($account)
    {
        return $this->account
                    ->where('account_number', $account['account_number'])
                    ->update($account);
    }

    public function destory($id)
    {
        return $this->account
                    ->where('account_number', $id)
                    ->delete();
    }
}
?>
