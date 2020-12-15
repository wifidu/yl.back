<?php


namespace App\Http\Service\MaterialManagement;

use App\Http\Repository\MaterialManagement\WareHouseLogRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class WareHouseLogService
{
    use ApiTraits;
    private $_wareHouseLogRepository;

    public function __construct(WareHouseLogRepository $wareHouseLogRepository)
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

    public function search($page, $page_size, $id, $start_time, $end_time)
    {
        $data   = $this->_wareHouseLogRepository->search($page, $page_size, $id, $start_time, $end_time);
        return $this->apiReturn($data,CodeEnum::SUCCESS);
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
