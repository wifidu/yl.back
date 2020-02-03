<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\CreditManagementService;

class CreditManagementController extends Controller
{
    protected $creditManagementService;

    public function __construct(CreditManagementService $creditManagementService)
    {
        $this->creditManagementService = $creditManagementService;
    }
    public function show()
    {
        $results = $this->creditManagementService->show();
        return $results;
    }
}
