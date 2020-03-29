<?php


namespace App\Http\Service\MemberManagement;


use App\Enum\CodeEnum;
use App\Events\OutManage;
use App\Http\Repository\MemberManagement\OutManageRepository;
use App\Traits\ApiTraits;
use Log;

class OutManageService
{
    use ApiTraits;
    private $_outManageRepository;

    public function __construct(OutManageRepository $outManageRepository)
    {
        $this->_outManageRepository = $outManageRepository;
    }

    /**
     * 存储或更新一个信息
     * @param $params
     * @return array
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));
        $id = $this->_outManageRepository->store($params);
        if ($id) {
            event(new OutManage($params));
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
        $data = $this->_outManageRepository->item($id);

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
        $data = $this->_outManageRepository->list($page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }


    /**
     * 取消预约
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $result = $this->_outManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        $res = $this->_outManageRepository->delete($id);
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
        $result = $this->_outManageRepository->search($params);
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
        $this->_outManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

}