<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 03:58:40 PM
 */

namespace App\Http\Controllers\Api\DailyManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DailyManagement\VisitRequest;
use App\Http\Service\DailyManagement\VisitService;
use Illuminate\Http\Request;

class VisitController extends Controller
{
    protected $visitService;

    public function __construct(VisitService $visitService)
    {
        $this->visitService = $visitService;
    }

    public function store(VisitRequest $request)
    {
        return $this->visitService->store($request->post());
    }

    public function update(VisitRequest $request)
    {
        return $this->visitService->update($request->all());
    }

    public function show(Request $request)
    {
        return $this->visitService->show($request->get('page', 1),
            $request->get('page_size', 15),
            $request->get('id', ''),
            $request->get('start_time', ''),
            $request->get('end_time', ''));
    }

    public function destroy($id)
    {
        return $this->visitService->destroy($id);
    }
}
