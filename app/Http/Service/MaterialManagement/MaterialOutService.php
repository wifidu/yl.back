<?php


namespace App\Http\Service\MaterialManagement;

use App\Http\Repository\MaterialManagement\MaterialOutRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class MaterialOutService
{
    use ApiTraits;
    private $_materialOUtRepository;

    public function __construct(MaterialOutRepository $materialOutRepository)
    {
        $this->_materialOUtRepository = $materialOutRepository;
    }

    /**
     * function 物资出库数据存储
     * describe 物资出库数据存储
     * @param $params
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:53
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_materialOUtRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 物资出库数据详情
     * describe 物资出库数据详情
     * @param $id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:53
     */
    public function detail($id)
    {
        $data = $this->_materialOUtRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 物资出库数据列表
     * describe 物资出库数据列表
     * @param $page 当前页数
     * @param $page_size 页数大小
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:53
     */
    public function list($page, $page_size)
    {
        $data = $this->_materialOUtRepository->list($page, $page_size);

        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 物资出库数据删除
     * describe 物资出库数据删除
     * @param $id 数据项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:54
     */
    public function delete($id)
    {
        $result = $this->_materialOUtRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_materialOUtRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 物资出库数据批量删除
     * describe 物资出库数据批量删除
     * @param $ids 多个数据项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:54
     */
    public function batchDelete($ids)
    {
        $this->_materialOUtRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 物资出库单号获取
     * describe 物资出库单号获取
     * @return string
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:47
     */
    public function CKoddNumber()
    {
        $RKOddNumber =  'CK'.date('Ymd').time();
        return $this->apiReturn(['CKoddNumber'=>$RKOddNumber],CodeEnum::SUCCESS);
    }
}