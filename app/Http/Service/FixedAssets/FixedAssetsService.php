<?php


namespace App\Http\Service\FixedAssets;

use App\Http\Repository\MaterialManagement\FixedAssetsRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class FixedAssetsService
{
    use ApiTraits;
    private $_fixedAssetsRepository;

    public function __construct(FixedAssetsRepository $fixedAssetsRepository)
    {
        $this->_fixedAssetsRepository = $fixedAssetsRepository;
    }

    /**
     * function 固定资产数据存储或更新
     * describe 固定资产数据存储或更新
     * @param $params
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:27
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_fixedAssetsRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 固定资产数据详情
     * describe 固定资产数据详情
     * @param $id 数据项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:28
     */
    public function detail($id)
    {
        $data = $this->_fixedAssetsRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 固定资产数据列表
     * describe 固定资产数据列表
     * @param $page 当前页数
     * @param $page_size 每页大小
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:28
     */
    public function list($page, $page_size)
    {
        $data = $this->_fixedAssetsRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 固定资产数据删除
     * describe 固定资产数据删除
     * @param $id 数据项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:29
     */
    public function delete($id)
    {
        $result = $this->_fixedAssetsRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_fixedAssetsRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 固定资产数据批量删除
     * describe 固定资产数据批量删除
     * @param $ids 多个数据项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:30
     */
    public function batchDelete($ids)
    {
        $this->_fixedAssetsRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}