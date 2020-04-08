<?php

/*
 * @author weifan
 * Monday 6th of April 2020 01:30:28 PM
 */

namespace App\Http\Controllers\Api\DailyManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\DailyManagement\ConsultRequest;
use App\Http\Service\DailyManagement\ConsultService;
use Illuminate\Http\Request;

class ConsultController extends Controller
{
    protected $consultService;

    public function __construct(ConsultService $consultService)
    {
        $this->consultService = $consultService;
    }

    public function index(Request $request)
    {
        return $this->consultService->index($request->get('page', ''),
            $request->get('page_size', ''),
            $request->get('start_time', ''),
            $request->get('end_time', ''));
    }

    public function show($id)
    {
        return $this->consultService->show($id);
    }

    public function store(ConsultRequest $request)
    {
        return $this->consultService->store($request->post());
    }

    public function update(ConsultRequest $request)
    {
        return $this->consultService->update($request->all());
    }

    public function destroy($id)
    {
        return $this->consultService->destroy($id);
    }
}
