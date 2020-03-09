<?php


namespace App\Http\Service\MaterialManagement;

use App\Http\Repository\MaterialManagement\InventoryManagementRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class InventoryManagementService
{
    use ApiTraits;
    private $_inventoryManagementRepository;

    public function __construct(InventoryManagementRepository $inventoryManagementRepository)
    {
        $this->_inventoryManagementRepository = $inventoryManagementRepository;
    }

    /**
     * function 盘点管理-盘点
     * describe 盘点管理-盘点
     * @param $params
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:01
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_inventoryManagementRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 盘点管理-数据详情
     * describe 盘点管理-数据详情
     * @param $id 盘点数据id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:02
     */
    public function detail($id)
    {
        $data = $this->_inventoryManagementRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 盘点管理数据列表
     * describe 盘点管理数据列表
     * @param $page 当前页数
     * @param $page_size 页面数据条数
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:02
     */
    public function list($page, $page_size)
    {
        $data = $this->_inventoryManagementRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 盘点管理数据删除
     * describe 盘点管理数据删除
     * @param $id 盘点数据id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:03
     */
    public function delete($id)
    {
        $result = $this->_inventoryManagementRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_inventoryManagementRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 盘点管理数据批量删除
     * describe 盘点管理数据批量删除
     * @param $ids
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:03
     */
    public function batchDelete($ids)
    {
        $this->_inventoryManagementRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 生成上月份盘点
     * describe 生成上月份盘点
     * @author ZhaoDaYuan
     * 2020/3/1 下午12:37
     */
    public function generate()
    {
        $this->_inventoryManagementRepository->generate();
    }

    /**
     * function 盘点管理-盘点详情
     * describe 盘点管理-盘点详情
     * @param $id 盘点id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/1 下午1:43
     */
    public function inventoryDetail($id)
    {
        $detail = $this->_inventoryManagementRepository->inventoryDetail($id);
        return $this->apiReturn($detail, CodeEnum::SUCCESS);

    }

    /**
     * function 盘点管理-搜索
     * describe 盘点管理-搜索
     * @param $search_index 搜索索引
     * @param $time_range 搜索时间范围
     * @param $content 搜索内容
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:00
     */
    public function search($search_index,$time_range,$content)
    {
        $search = $this->_inventoryManagementRepository->search($search_index,$time_range,$content);
        return $this->apiReturn($search,CodeEnum::SUCCESS);
    }
}