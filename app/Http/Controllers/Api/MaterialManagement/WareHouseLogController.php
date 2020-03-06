<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\WareHouseLogService;
use App\Http\Requests\Api\MaterialManagement\WareHouseLogRequest;
use Dingo\Api\Contract\Http\Request;

class WareHouseLogController
{
    private $_wareHouseLogService;

    public function __construct(WareHouseLogService $wareHouseLogService)
    {
        $this->_wareHouseLogService = $wareHouseLogService;
    }

    /**
     * function 仓库日志-数据详情
     * describe 仓库日志-数据详情
     * @param $id 仓库日志id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:12
     */
    public function detail($id)
    {
        return $this->_wareHouseLogService->detail($id);
    }

    /**
     * function 仓库日志-数据列表
     * describe 仓库日志-数据列表
     * @param Request $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:12
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_wareHouseLogService->list($page, $page_size);
    }

    /**
     * function 仓库日志数据删除
     * describe 仓库日志数据删除
     * @param $id 仓库日志id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:11
     */
    public function delete($id)
    {
        return $this->_wareHouseLogService->delete($id);
    }

    /**
     * function 仓库日志数据批量删除
     * describe 仓库日志数据批量删除
     * @param WareHouseLogRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:11
     */
    public function batchDelete(WareHouseLogRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_wareHouseLogService->batchDelete($ids);
    }

    /**
     * function 仓库日志-搜索
     * describe 仓库日志-搜索
     * @param WareHouseLogRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:10
     */
    public function search(WareHouseLogRequest $request)
    {
        $search_index   = $request->post('search_index') ?? 'odd_number';
        $time_range     = $request->post('time_range') ?? 'all';
        $operator_type  = $request->post('operator_type') ?? 'all';
        $warehouse_name = $request->post('warehouse_name') ?? 'all';
        $content        = $request->post('content') ?? '';

        return $this->_wareHouseLogService->search((string)$search_index,(string)$time_range,(string)$operator_type,(string)$warehouse_name,(string)$content);
    }

    /**
     * function 仓库日志导出EXCEL
     * describe 仓库日志导出EXCEL
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:10
     */
    public function excelExport()
    {
        return $this->_wareHouseLogService->excelExport();
    }
}