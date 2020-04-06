<?php

/*
 * @author weifan
 * Monday 6th of April 2020 12:55:31 PM
 */

namespace App\Http\Service\DailyManagement;

use App\Enum\CodeEnum;
use App\Http\Repository\DailyManagement\ConsultRepository;
use App\Traits\ApiTraits;

class ConsultService
{
    use ApiTraits;

    protected $consultRepository;

    public function __construct(ConsultRepository $consultRepositroy)
    {
        $this->consultRepository = $consultRepositroy;
    }

    public function store($consult)
    {
        $data['id'] = $this->consultRepository->store($this->fomatTrans($consult));

        $result = $this->resultIs($data['id']);

        return $this->apiReturn($data, $result);
    }

    public function index($page, $page_size, $start_time, $end_time)
    {
        return $this->apiReturn($this->fomatTrans($this->consultRepository->index($page, $page_size, $start_time, $end_time), -1), CodeEnum::SUCCESS);
    }

    public function show($id)
    {
        return $this->apiReturn($this->fomatTrans($this->consultRepository->show($id), -1), CodeEnum::SUCCESS);
    }

    public function update($consult)
    {
        $result = $this->consultRepository->update($this->fomatTrans($consult));

        return $this->apiReturn(['id' => $consult['id']], $this->resultIs($result));
    }

    public function destroy($id)
    {
        return $this->apiReturn(['id' => $id], $this->resultIs($this->consultRepository->destroy($id)));
    }

    public function resultIs($result)
    {
        return empty($result) ? CodeEnum::FAIL : CodeEnum::SUCCESS;
    }

    public function fomatTrans($data, $type = 1) // type = 1 为存储
    {
        if (1 == $type) {
            if (!isset($data['time'])) {
                return $data;
            }
            $data['time'] = (int) strtotime($data['time']);

            return $data;
        }
        foreach ($data as $visit) {
            $visit['time'] = date('Y-m-d H:i:s', $visit['time']);
        }

        return $data;
    }
}
