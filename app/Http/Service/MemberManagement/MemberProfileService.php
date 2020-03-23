<?php


namespace App\Http\Service\MemberManagement;


use App\Enum\CodeEnum;
use App\Events\MemberProfile;
use App\Http\Repository\MemberManagement\MemberProfileRepository;
use App\Traits\ApiTraits;
use Log;

/**
 * 会员档案服务类
 * Class MemberProfileService
 * @package App\Http\Service\MemberProfileController
 * @author YanJiGang
 */
class MemberProfileService
{
    use ApiTraits;
    private $_memberProfileRepository;

    public function __construct(MemberProfileRepository $memberProfileRepository)
    {
        $this->_memberProfileRepository = $memberProfileRepository;
    }

    /**
     * 存储或更新一个会员信息
     * @param $params
     * @return array
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));
        $id = $this->_memberProfileRepository->store($params);
        if ($id) {
            event(new MemberProfile($id));
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }
        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * 获取一个会员的详细信息
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        $data = $this->_memberProfileRepository->item($id);

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
        $data = $this->_memberProfileRepository->list($page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }


    /**
     * 删除一个会员
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $result = $this->_memberProfileRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_memberProfileRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * 通过手机号或人名搜索会员
     * @param $params
     * @return array
     */
    public function search($params)
    {
        $result = $this->_memberProfileRepository->search($params);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        return $this->apiReturn($result, CodeEnum::SUCCESS);
    }

}