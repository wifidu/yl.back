<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\MaterialInService;
use App\Http\Requests\Api\MaterialManagement\MaterialInRequest;
use Dingo\Api\Contract\Http\Request;

class MaterialInController
{
    private $_materialInService;

    public function __construct(MaterialInService $materialInService)
    {
        $this->_materialInService = $materialInService;
    }

    /**
     * function 物资入库数据存储或更新
     * describe 物资入库数据存储或更新
     * @param MaterialRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/18 上午11:11
     */
    public function store(MaterialInRequest $request)
    {
        $params = $request->post();
        return $this->_materialInService->store($params);
    }

    /**
     * function 物资入库数据详情
     * describe 物资入库数据详情
     * @param $id 物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/18 上午11:13
     */
    public function detail($id)
    {
        return $this->_materialInService->detail($id);
    }

    /**
     * function 物资入库数据列表
     * describe 物资入库数据列表
     * @param Request $request 包含$page,$page_size
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/18 上午11:15
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_materialInService->list($page, $page_size);
    }

    /**
     * function 物资入库数据删除
     * describe 物资入库数据删除
     * @param $id 物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/18 上午11:21
     */
    public function delete($id)
    {
        return $this->_materialInService->delete($id);
    }

    /**
     * function 物资入库数据批量删除
     * describe 物资入库数据批量删除
     * @param MaterialRequest $request 多个物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/18 上午11:22
     */
    public function batchDelete(MaterialInRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_materialInService->batchDelete($ids);
    }

    /**
 * function 物资入库单号获取
 * describe 物资入库单号获取
 * @return string
 * @author ZhaoDaYuan
 * 2020/2/24 上午11:46
 */
    public function RKoddNumber()
    {
        return $this->_materialInService->RKoddNumber();
    }
}