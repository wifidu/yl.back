<?php


namespace App\Http\Service\DietManage;

use App\Http\Repository\DietManage\DeliveryManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class DeliveryManageService
{
    use ApiTraits;
    private $_deliveryManageRepository;

    public function __construct(DeliveryManageRepository $DeliveryManageRepository)
    {
        $this->_deliveryManageRepository = $DeliveryManageRepository;
    }

    /**
     * function 新增、编辑配送信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:20
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_deliveryManageRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 配送详情
     * describe 查看配送信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:20
     */
    public function detail($id)
    {
        $data = $this->_deliveryManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 配送删除
     * describe 删除配送信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:20
     */
    public function delete($id)
    {
        $result = $this->_deliveryManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_deliveryManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 配送数据列表
     * describe 配送数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:21
     */
    public function list($page, $page_size)
    {
        $data = $this->_deliveryManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 配送数据批量删除
     * describe 配送数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:21
     */
    public function batchDelete($ids)
    {
        $this->_deliveryManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 配送
     * describe 配送
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:21
     */
    public function delivery($id)
    {
        $result = $this->_deliveryManageRepository->delivery($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }elseif ($result == 1){
            return $this->apiReturn('', CodeEnum::REPEAT_OPERATE);
        }

        return $this->apiReturn('', CodeEnum::SUCCESS);

    }
}