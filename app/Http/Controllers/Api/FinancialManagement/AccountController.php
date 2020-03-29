<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 11:52:03 AM
 */

namespace App\Http\Controllers\Api\FinancialManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\FinancialManagement\AccountRequest;
use App\Http\Service\FinancialManagement\AccountService;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    protected $accountService;

    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function store(AccountRequest $request)
    {
        $account = $request->post();

        return $this->accountService->store($account);
    }

    public function destory($id)
    {
        return $this->accountService->destory($id);
    }

    public function update(AccountRequest $request)
    {
        $account = $request->all();

        return $this->accountService->update($account);
    }

    public function show(Request $request)
    {
        if ($request->filled('no')) {
            return $this->accountService->showWithNo($request->get('no'), $request->get('page', 1), $request->get('page_size', 15));
        }

        return $this->accountService->show($request->get('page', 1), $request->get('page_size', 15));
    }

    public function showDeposit(Request $request)
    {
        return $this->accountService
                  ->showDeposit($request->get('member_name', 'null'), $request->get('page', 1), $request->get('page_size', 15));
    }

    public function updateBalance(AccountRequest $request)
    {
        return $this->accountService
                    ->updateBalance($request->input('id'), $request->input('money'));
    }
}
