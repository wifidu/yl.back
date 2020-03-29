<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Events\MaterialOut;
use App\Events\WarehouseLog;
use App\Http\Service\MaterialManagement\MaterialOutService;
use App\Http\Requests\Api\MaterialManagement\MaterialOutRequest;
use Dingo\Api\Contract\Http\Request;

class MaterialOutController
{
    private $_materialOutService;

    public function __construct(MaterialOutService $materialOutService)
    {
        $this->_materialOutService = $materialOutService;
    }

    /**
     * function 物资出库数据存储
     * describe 物资出库数据存储
     * @param MaterialOutRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:48
     */
    public function store(MaterialOutRequest $request)
    {
        $params = $request->post();
        event(new WarehouseLog($params));
        event(new MaterialOut($params));
        return $this->_materialOutService->store($params);
    }

    /**
     * function 物资出库数据详情
     * describe 物资出库数据详情
     * @param $id 数据项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:48
     */
    public function detail($id)
    {
        return $this->_materialOutService->detail($id);
    }

    /**
     * function 物资出库数据列表
     * describe 物资出库数据列表
     * @param Request $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:48
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_materialOutService->list($page, $page_size);
    }

    /**
     * function 物资出库数据删除
     * describe 物资出库数据删除
     * @param $id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:49
     */
    public function delete($id)
    {
        return $this->_materialOutService->delete($id);
    }

    /**
     * function 物资出库数据批量删除
     * describe 物资出库数据批量删除
     * @param MaterialOutRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/24 上午11:49
     */
    public function batchDelete(MaterialOutRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_materialOutService->batchDelete($ids);
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
        return $this->_materialOutService->CKoddNumber();
    }
}