<?php

namespace App\Http\Controllers\Api\FinancialManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\FinancialManagement\AccountService;

class AccountController extends Controller
{
    protected $accountService;
    
    public function __construct(AccountService $accountService)
    {
        $this->accountService = $accountService;
    }

    public function store(Request $request)
    {
        $account = $request->post();
        return $this->accountService->store($account);
    }

    public function destory($id)
    {
        return $this->accountService->destory($id);
    }

    public function update(Request $request)
    {
        $account = $request->all();
        return $this->accountService->update($account);
    }

    public function show(Request $request)
    {
      $page = $request->page ?? 1;
      $page_size = $request->page_size ?? 15;
      return $this->accountService->show($page, $page_size);
    }

    public function showWithNo($no, Request $request)
    {
      $page = $request->page ?? 1;
      $page_size = $request->page_size ?? 15;
      return $this->accountService->showWithNo($no, $page, $page_size);
    }
}
