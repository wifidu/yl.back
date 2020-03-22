<?php
namespace App\Http\Service\FinancialManagement;

use App\Enum\CodeEnum;
use App\Http\Repository\FinancialManagement\AccountRespository;
use App\Traits\ApiTraits;
use Illuminate\Http\Request;

class AccountService
{
    use ApiTraits;

    protected $accountRespository;

    public function __construct(AccountRespository $accountRespository)
    {
       $this->accountRespository = $accountRespository;
    }

    public function store($account)
    {
        $result = $this->accountRespository->store($account);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['account_number' => $account['account_number']], $result);
    }

    public function destory($id)
    {
        $result = $this->accountRespository->destory($id);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['id' => $id], $result);
    }

    public function update($account)
    {
        $result = $this->accountRespository->update($account);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['id' => $account['id']], $result);
    }

    public function show($page, $page_size)
    {
        $accounts = $this->accountRespository->show($page, $page_size);
        return $this->apiReturn($accounts, CodeEnum::SUCCESS);
    }

    public function showWithNo($no, $page, $page_size)
    {
        $accounts = $this->accountRespository->showWithNo($no, $page, $page_size);
        return $this->apiReturn($accounts, CodeEnum::SUCCESS);
    }

    /**
     * function showDeposit
     * describe 查询押金
     * @param   $menmber_name, $page, $page_size
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-04 16:29:S
     */
    public function showDeposit($menmber_name, $page, $page_size)
    {
        $deposit = $this->accountRespository->showDeposit($menmber_name, $page, $page_size);
        return $this->apiReturn($deposit, CodeEnum::SUCCESS);
    }

    public function updateBalance($id, $money)
    {
        $result = $this->accountRespository->updateBalance($id, $money);
        $result = $result == true ? CodeEnum::SUCCESS : CodeEnum::FAIL;
        return $this->apiReturn(['id' => $id], $result);
    }
}
?>
