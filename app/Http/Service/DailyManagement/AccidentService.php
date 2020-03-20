<?php
namespace App\Http\Service\DailyManagement;

use App\Enum\CodeEnum;
use App\Http\Repository\DailyManagement\AccidentRepository;
use App\Model\Account;
use App\Traits\ApiTraits;

class AccidentService{
    protected $accidentRepository;

    use ApiTraits;

    public function __construct(AccidentRepository $accidentRepository)
    {
        $this->accidentRepository = $accidentRepository;
    }

    public function destory($id)
    {
        $result = $this->accidentRepository->destory($id);
        return $this->apiReturn(['id' => $id], $this->resultIs($result));
    }

    public function store($data)
    {
        if (empty($data['account_id'] = $this->getAccountId($data)))
            return $this->apiReturn(['member_name' => '该会员不存在'], CodeEnum::NON_EXISTENT);
        $data = $this->fomatTrans($data, 1);
        $result = $this->accidentRepository->store($data);
        return $this->apiReturn(['id' => $result], $this->resultIs($result));
    }

    public function update($data)
    {
        if (empty($data['account_id'] = $this->getAccountId($data)))
            return $this->apiReturn(['member_name' => '该会员不存在'], CodeEnum::NON_EXISTENT);
        $data = $this->fomatTrans($data, 1);
        unset($data['member_name']);
        $result = $this->accidentRepository->update($data);
        return $this->apiReturn(['id' => $data['id']], $this->resultIs($result));
    }

    public function show($page, $page_size, $start_time = '', $end_time = '', $name = '', $id = '')
    {
        $data = $this->accidentRepository->show($page, $page_size, $start_time, $end_time, $name, $id);
        $data = $this->fomatTrans($data, 0);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    public function resultIs($result)
    {
        return empty($result) ? CodeEnum::FAIL : CodeEnum::SUCCESS;
    }

    public function fomatTrans($data, $type = 1) // type = 1 为存储
    {
        if ($type == 1) {
            $data['occurrence_time'] = (int) strtotime($data['occurrence_time']);
            return $data;
        }
        foreach ($data as $accident) {
            $accident['occurrence_time'] = date('Y-m-d H:i:s', $accident['occurrence_time']);
            switch ($accident['level_accident']) {
                case 0:
                    $accident['level_accident'] = '轻微';
                    break;
                case 1:
                    $accident['level_accident'] = '一般';
                    break;
                case 2:
                    $accident['level_accident'] = '严重';
                    break;
            }
        }
        return $data;
    }

    public function getAccountId($data)
    {
        $id = Account::where('member_name', $data['member_name'])->value('id');
        return $id ? $id : null;
    }

}
?>
