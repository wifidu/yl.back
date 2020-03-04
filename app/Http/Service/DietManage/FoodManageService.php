<?php


namespace App\Http\Service\DietManage;

use App\Http\Repository\DietManage\FoodManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class FoodManageService
{
    use ApiTraits;
    private $_foodManageRepository;

    public function __construct(FoodManageRepository $FoodManageRepository)
    {
        $this->_foodManageRepository = $FoodManageRepository;
    }

    /**
     * function 新增、编辑单品信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:47
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_foodManageRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 单品详情
     * describe 查看单品信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:48
     */
    public function detail($id)
    {
        $data = $this->_foodManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 单品删除
     * describe 删除单品信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:48
     */
    public function delete($id)
    {
        $result = $this->_foodManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_foodManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 单品数据列表
     * describe 单品数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:49
     */
    public function list($page, $page_size)
    {
        $data = $this->_foodManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 单品数据批量删除
     * describe 单品数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-02-29 18:49
     */
    public function batchDelete($ids)
    {
        $this->_foodManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 改变单品状态
     * describe 改变单品状态
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-01 19:16
     */
    public function typeChange($id)
    {
        $result = $this->_foodManageRepository->typeChange($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        return $this->apiReturn('', CodeEnum::SUCCESS);

    }
}