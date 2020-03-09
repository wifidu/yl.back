<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\InventoryManagementService;
use App\Http\Requests\Api\MaterialManagement\InventoryManagementRequest;
use Dingo\Api\Contract\Http\Request;


class InventoryManagementController
{
    private $_inventoryManagementService;

    public function __construct(InventoryManagementService $inventoryManagementService)
    {
        $this->_inventoryManagementService = $inventoryManagementService;
    }

    /**
     * function 盘点管理-盘点
     * describe 盘点管理-盘点
     * @param InventoryManagementRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午4:58
     */
    public function store(InventoryManagementRequest $request)
    {
        $params = $request->post();
        return $this->_inventoryManagementService->store($params);
    }

    /**
     * function 盘点管理-数据详情
     * describe 盘点管理-数据详情
     * @param $id 盘点数据id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午4:59
     */
    public function detail($id)
    {
        return $this->_inventoryManagementService->detail($id);
    }

    /**
     * function 盘点管理数据列表
     * describe 盘点管理数据列表
     * @param Request $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午4:59
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_inventoryManagementService->list($page, $page_size);
    }

    /**
     * function 盘点管理数据删除
     * describe 盘点管理数据删除
     * @param $id
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午4:59
     */
    public function delete($id)
    {
        return $this->_inventoryManagementService->delete($id);
    }


    /**
     * function 盘点管理数据批量删除
     * describe 盘点管理数据批量删除
     * @param FixedAssetsRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/3/5 下午5:00
     */
    public function batchDelete(InventoryManagementRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_inventoryManagementService->batchDelete($ids);
    }

    /**
     * function 生成上月份盘点
     * describe 生成上月份盘点
     * @author ZhaoDaYuan
     * 2020/2/29 下午6:36
     */
    public function generate()
    {
        $this->_inventoryManagementService->generate();
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
        return $this->_inventoryManagementService->inventoryDetail($id);
    }

    public function search(InventoryManagementRequest $request)
    {
        $search_index   = $request->post('search_index') ?? 'name';
        $time_range     = (int)$request->post('time_range') ?? 'all';
        $content        = $request->post('content') ?? '';

        return $this->_inventoryManagementService->search($search_index,$time_range,$content);
    }
}