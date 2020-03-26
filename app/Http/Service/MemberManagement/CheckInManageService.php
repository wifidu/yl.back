<?php


namespace App\Http\Service\MemberManagement;


use App\Enum\CodeEnum;
use App\Events\CheckIn;
use App\Events\CheckInChange;
use App\Http\Repository\MemberManagement\BookBedRepository;
use App\Http\Repository\MemberManagement\CheckInManageRepository;
use App\Model\CheckInManage;
use App\Traits\ApiTraits;
use Log;
use Storage;

class CheckInManageService
{
    use ApiTraits;
    private $_checkInManageRepository;

    public function __construct(CheckInManageRepository $checkInManageRepository)
    {
        $this->_checkInManageRepository = $checkInManageRepository;
    }

    /**
     * 存储或更新一个入住信息
     * @param $params
     * @return array
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_checkInManageRepository->store($params);
        if ($id) {
            event(new CheckIn($params));
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * 获取一个入住登记的详细信息
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        $data = $this->_checkInManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 获取入住登记列表
     * @param $page_size
     * @return array
     */
    public function list($page_size)
    {
        $data = $this->_checkInManageRepository->list($page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }


    /**
     * 删除某条记录（ 软删除 ）
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $result = $this->_checkInManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        $res = $this->_checkInManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * 通过人名搜索入住登记信息
     * @param $params
     * @return array
     */
    public function search($params)
    {
        $result = $this->_checkInManageRepository->search($params);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        return $this->apiReturn($result, CodeEnum::SUCCESS);
    }

    /**
     * 批量删除入住登记
     * @param $ids
     * @return array
     */
    public function batchDelete($ids)
    {
        $this->_checkInManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }


    /**
     * 处理上传文件
     * @param $id
     * @param $file
     * @return array
     */
    public function upload($id, $file)
    {
        $path = Storage::putFile("medical_report", $file);

        $ok = $this->_checkInManageRepository->upload($id, $file);
        if ($ok) {
            return $this->apiReturn($path, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * 业务变更以及膳食变更 api
     * @param $params
     * @return array
     */
    public function change($params)
    {
        $ok = $this->_checkInManageRepository->change($params);
        if ($ok) {
            event(new CheckInChange($params));
            return $this->apiReturn('', CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

}