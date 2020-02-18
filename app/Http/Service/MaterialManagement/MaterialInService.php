<?php


namespace App\Http\Service\MaterialManagement;

use App\Http\Repository\MaterialManagement\MaterialInRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class MaterialInService
{
    use ApiTraits;
    private $_materialInRepository;

    public function __construct(MaterialInRepository $materialInRepository)
    {
        $this->_materialInRepository = $materialInRepository;
    }

    /**
     * function 物资数据存储或更新
     * describe 物资数据存储或更新
     * @param $params
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:11
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_materialInRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 物资数据详情
     * describe 物资数据详情
     * @param $id 物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:14
     */
    public function detail($id)
    {
        $data = $this->_materialInRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 物资数据列表
     * describe 物资数据列表
     * @param $page  当前页数
     * @param $page_size 页面大小
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:16
     */
    public function list($page, $page_size)
    {
        $data = $this->_materialInRepository->list($page, $page_size);

        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 物资数据删除
     * describe 物资数据删除
     * @param $id 物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:21
     */
    public function delete($id)
    {
        $result = $this->_materialInRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_materialInRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 物资数据批量删除
     * describe 物资数据批量删除
     * @param $ids 多个物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:22
     */
    public function batchDelete($ids)
    {
        $this->_materialInRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}