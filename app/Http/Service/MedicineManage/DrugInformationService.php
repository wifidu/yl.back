<?php


namespace App\Http\Service\MedicineManage;


use App\Enum\CodeEnum;
use App\Http\Repository\MedicineManage\DrugInformationRepository;
use App\Traits\ApiTraits;
use Log;

class DrugInformationService
{ 
    use ApiTraits;
    private $_drugInformationRepository;

    public function __construct(DrugInformationRepository $drugInformationRepository)
    {
        $this->_drugInformationRepository = $drugInformationRepository;
    }

    /**
     * 存储或更新一个信息
     * @param $params
     * @return array
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));
        $id = $this->_drugInformationRepository->store($params);
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
        $data = $this->_drugInformationRepository->item($id);

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
        $data = $this->_drugInformationRepository->list($page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }


    /**
     * 删除一条药品信息
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        $result = $this->_drugInformationRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }

        $res = $this->_drugInformationRepository->delete($id);
        if (!$res) {
            return $this->apiReturn('', CodeEnum::FAIL);
        }

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * 通过药品搜索药品信息
     * @param $params
     * @return array
     */
    public function search($params)
    {
        $result = $this->_drugInformationRepository->search($params);
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
        $this->_drugInformationRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }


}