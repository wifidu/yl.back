<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 02:35:29 PM
 */

namespace App\Http\Service\DailyManagement;

use App\Enum\CodeEnum;
use App\Http\Repository\DailyManagement\VisitRepository;
use App\Traits\ApiTraits;

class VisitService
{
    protected $visitRepository;
    use ApiTraits;

    public function __construct(VisitRepository $visitRepository)
    {
        $this->visitRepository = $visitRepository;
    }

    public function store($data)
    {
        $data['id'] = $this->visitRepository->store($this->fomatTrans($data));
        $result = $this->resultIs($data['id']);

        return $this->apiReturn($data, $result);
    }

    public function update($data)
    {
        $result = $this->resultIs($this->visitRepository->update($this->fomatTrans($data)));

        return $this->apiReturn($data, $result);
    }

    public function show($page, $page_size, $id, $start_time, $end_time)
    {
        $data   = $this->visitRepository->show($page, $page_size, $id, $start_time, $end_time);
        $result = $this->resultIs($data);

        return $this->apiReturn($this->fomatTrans($data, 0), $result);
    }

    public function destroy($id)
    {
        return $this->apiReturn(['id' => $id], $this->resultIs($this->visitRepository->destroy($id)));
    }

    public function resultIs($result)
    {
        return empty($result) ? CodeEnum::FAIL : CodeEnum::SUCCESS;
    }

    public function fomatTrans($data, $type = 1) // type = 1 为存储
    {
        if (1 == $type) {
            if (!isset($data['visit_time'])) {
                return $data;
            }
            $data['visit_time'] = (int) strtotime($data['visit_time']);

            return $data;
        }
        foreach ($data as $visit){
            $visit['visit_time'] = date('Y-m-d H:i:s', $visit['visit_time']);
        }

        return $data;
    }
}
