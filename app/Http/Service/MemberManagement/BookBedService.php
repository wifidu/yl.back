<?php


namespace App\Http\Service\MemberManagement;


use App\Enum\CodeEnum;
use App\Events\BookBed;
use App\Http\Repository\MemberManagement\BookBedRepository;
use App\Traits\ApiTraits;
use Log;

class BookBedService
{
    use ApiTraits;
    private $_bookBedRepository;

    public function __construct(BookBedRepository $bookBedRepository)
    {
        $this->_bookBedRepository = $bookBedRepository;
    }

    /**
     * 存储或更新一个床位预约信息
     * @param $params
     * @return array
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));
        $id = $this->_bookBedRepository->store($params);
        if ($id) {
            event(new BookBed($params));
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * 获取一个预约床位的详细信息
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        $data = $this->_bookBedRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 获取会员列表
     * @param $page_size
     * @return array
     */
    public function list($page_size)
    {
        $data = $this->_bookBedRepository->list($page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }


    /**
     * 取消预约
     * @param $id
     * @return array
     */
    public function cancel($id)
    {
        $result = $this->_bookBedRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        $res = $this->_bookBedRepository->cancel($id);
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
        $result = $this->_bookBedRepository->search($params);
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
        $this->_bookBedRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

}