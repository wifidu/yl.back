<?php


namespace App\Http\Service\DietManage;

use App\Http\Repository\DietManage\PackageManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class PackageManageService
{
    use ApiTraits;
    private $_packageManageRepository;

    public function __construct(PackageManageRepository $PackageManageRepository)
    {
        $this->_packageManageRepository = $PackageManageRepository;
    }

    /**
     * function 新增、编辑套餐信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:08
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_packageManageRepository->store($params);
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
     * 2020-03-06 23:09
     */
    public function detail($id)
    {
        $data = $this->_packageManageRepository->item($id);

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
     * 2020-03-06 23:09
     */
    public function delete($id)
    {
        $result = $this->_packageManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_packageManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 套餐数据列表
     * describe 套餐数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:10
     */
    public function list($page, $page_size)
    {
        $data = $this->_packageManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 套餐数据批量删除
     * describe 套餐数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:11
     */
    public function batchDelete($ids)
    {
        $this->_packageManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 预定套餐
     * describe 预定套餐
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-06 23:12
     */
    public function order($id)
    {
        $result = $this->_packageManageRepository->order($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        return $this->apiReturn('', CodeEnum::SUCCESS);

    }
}