<?php


namespace App\Http\Service\MemberManagement;


use App\Enum\CodeEnum;
use App\Http\Repository\MemberManagement\DeathRegistrationRepository;
use App\Http\Repository\MemberManagement\OutManageRepository;
use App\Traits\ApiTraits;
use Log;

class DeathRegistrationService
{
    use ApiTraits;
    private $_deathRegistration;

    public function __construct(DeathRegistrationRepository $deathRegistrationRepository)
    {
        $this->_deathRegistration = $deathRegistrationRepository;
    }

    /**
     * 存储或更新一个信息
     * @param $params
     * @return array
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));
        $id = $this->_deathRegistration->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * 获取一个详细信息
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        $data = $this->_deathRegistration->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * 获取列表
     * @param $page_size
     * @return array
     */
    public function list($page_size)
    {
        $data = $this->_deathRegistration->list($page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }


    /**
     * 取消预约
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $result = $this->_deathRegistration->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        $res = $this->_deathRegistration->delete($id);
        if (!$res) {
            return $this->apiReturn('', CodeEnum::FAIL);
        }

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * 通过手机号或人名搜索预约床位信息
     * @param $params
     * @return array
     */
    public function search($params)
    {
        $result = $this->_deathRegistration->search($params);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        return $this->apiReturn($result, CodeEnum::SUCCESS);
    }

    /**
     * @param $ids
     * @return array
     */
    public function batchDelete($ids)
    {
        $this->_deathRegistration->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

}