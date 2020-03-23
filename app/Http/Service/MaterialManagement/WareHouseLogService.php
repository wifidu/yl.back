<?php


namespace App\Http\Service\MaterialManagement;

use App\Http\Repository\MaterialManagement\WaitingChargesRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class WareHouseLogService
{
    use ApiTraits;
    private $_wareHouseLogRepository;

    public function __construct(WaitingChargesRepository $wareHouseLogRepository)
    {
        $this->_wareHouseLogRepository = $wareHouseLogRepository;
    }

    /**
     * function 仓库日志数据详情
     * describe 仓库日志数据详情
     * @param $id 仓库日志数据id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:18
     */
    public function detail($id)
    {
        $data = $this->_wareHouseLogRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 仓库日志数据列表
     * describe 仓库日志数据列表
     * @param $page 当前页数
     * @param $page_size 页数大小
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:17
     */
    public function list($page, $page_size)
    {
        $data = $this->_wareHouseLogRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 仓库日志数据删除
     * describe 仓库日志数据删除
     * @param $id 仓库日志id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:17
     */
    public function delete($id)
    {
        $result = $this->_wareHouseLogRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_wareHouseLogRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 仓库日志数据批量删除
     * describe 仓库日志数据批量删除
     * @param $ids 多个仓库日志数据id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:16
     */
    public function batchDelete($ids)
    {
        $this->_wareHouseLogRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 仓库日志-搜索
     * describe 仓库日志-搜索
     * @param $search_index 搜索索引
     * @param $time_range 搜索时间范围
     * @param $operator_type 操作类型
     * @param $warehouse_name 仓库名称
     * @param $content 搜索内容
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:14
     */
    public function search($search_index,$time_range,$operator_type,$warehouse_name,$content)
    {
        $search = $this->_wareHouseLogRepository->search($search_index,$time_range,$operator_type,$warehouse_name,$content);
        return $this->apiReturn($search,CodeEnum::SUCCESS);
    }

    /**
     * function 仓库日志导出EXCEL
     * describe 仓库日志导出EXCEL
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:14
     */
    public function excelExport()
    {
        return $this->_wareHouseLogRepository->excelExport();
    }
}