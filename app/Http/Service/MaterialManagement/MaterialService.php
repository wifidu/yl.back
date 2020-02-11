<?php


namespace App\Http\Service\MaterialManagement;

use App\Http\Repository\MaterialManagement\MaterialRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class MaterialService
{
    use ApiTraits;
    private $_materialRepository;

    public function __construct(MaterialRepository $materialRepository)
    {
        $this->_materialRepository = $materialRepository;
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

        $id = $this->_materialRepository->store($params);
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
        $data = $this->_materialRepository->item($id);

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
        $data = $this->_materialRepository->list($page, $page_size);
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
        $result = $this->_materialRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_materialRepository->delete($id);

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
        $this->_materialRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}