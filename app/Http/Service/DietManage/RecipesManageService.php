<?php


namespace App\Http\Service\DietManage;

use App\Http\Repository\DietManage\RecipesManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class RecipesManageService
{
    use ApiTraits;
    private $_recipesManageRepository;

    public function __construct(RecipesManageRepository $RecipesManageRepository)
    {
        $this->_recipesManageRepository = $RecipesManageRepository;
    }

    /**
     * function 新增、编辑套餐信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:42
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_recipesManageRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 套餐详情
     * describe 查看套餐信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:42
     */
    public function detail($id)
    {
        $data = $this->_recipesManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 套餐删除
     * describe 删除套餐信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:42
     */
    public function delete($id)
    {
        $result = $this->_recipesManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_recipesManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 套餐数据列表
     * describe 套餐数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:43
     */
    public function list($page, $page_size)
    {
        $data = $this->_recipesManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 套餐数据批量删除
     * describe 套餐数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-03-13 22:43
     */
    public function batchDelete($ids)
    {
        $this->_recipesManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

}