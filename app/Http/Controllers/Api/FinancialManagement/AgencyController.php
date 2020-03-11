<?php

namespace App\Http\Controllers\Api\FinancialManagement;

use App\Http\Controllers\Controller;
use App\Http\Service\FinancialManagement\AgencyService;
use App\Http\Requests\Api\FinancialManagement\AgencyRequest;
use Illuminate\Http\Request;

class AgencyController extends Controller
{
    protected $agencyService;

    public function __construct(AgencyService $agencyService)
    {
       $this->agencyService = $agencyService;
    }

    /**
     * function show
     * describe 查询所有机构账户
     * @param   $request
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-01 11:00:S
     */
    public function show(Request $request)
    {
        $page            = $request->page ?? 1;
        $page_size       = $request->page_size ?? 15;
        $business_number = $request->business_number ?? null;
        $start_time      = $request->start_time ?? null;
        $end_time        = $request->end_time ?? null;
        return $this->agencyService->show($page,
                                          $page_size,
                                          $business_number,
                                          $start_time,
                                          $end_time);
    }

    /**
     * function store
     * describe 增加机构账户
     * @param   Request $request
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-01 11:14:S
     */
    public function store(AgencyRequest $request)
    {
        $agency = $request->post();
        return $this->agencyService->store($agency);
    }

    /**
     * function update
     * describe 更新机构账户
     * @param   Request $request
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-01 13:12:S
     */
    public function update(Request $request)
    {
        $agency = $request->all();
        return $this->agencyService->update($agency);
    }

    /**
     * function destory
     * describe 删除机构账户
     * @param   Request $request
     * @return  Array
     * @author  DuWeifan
     * date     2020-03-01 13:15:S
     */
    public function destory($business_number)
    {
        return $this->agencyService->destory($business_number);
    }
}
