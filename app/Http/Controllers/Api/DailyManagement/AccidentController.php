<?php

namespace App\Http\Controllers\Api\DailyManagement;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Service\DailyManagement\AccidentService;
use App\Http\Requests\Api\DailyManagement\AccidentRequest;

class AccidentController extends Controller
{
    protected $accidentService;

    public function __construct(AccidentService $accidentService)
    {
        $this->accidentService = $accidentService;
    }

    public function store(AccidentRequest $request)
    {
        $data = $request->post();
        return $this->accidentService->store($data);
    }

    public function destory($id)
    {
        return $this->accidentService->destory($id);
    }

    public function update(AccidentRequest $request) // 如果更新失败，说明数据重复
    {
        return $this->accidentService->update($request->all());
    }

    public function show(Request $request)
    {
        return $this->accidentService->show($request->get('page', 1),
                                            $request->get('page_size', 15),
                                            $request->get('start_time'),
                                            $request->get('end_time'),
                                            $request->get('name'),
                                            $request->get('id'));
    }

}
