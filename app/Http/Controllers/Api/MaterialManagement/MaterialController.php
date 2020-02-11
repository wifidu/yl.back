<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\MaterialManagement\MaterialService;
use App\Http\Requests\Api\MaterialManagement\MaterialRequest;
use Dingo\Api\Contract\Http\Request;

class MaterialController
{
    private $_materialService;

    public function __construct(MaterialService $materialService)
    {
        $this->_materialService = $materialService;
    }

    /**
     * function 物资数据存储或更新
     * describe 物资数据存储或更新
     * @param MaterialRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:11
     */
    public function store(MaterialRequest $request)
    {
        $params = $request->post();
        return $this->_materialService->store($params);
    }

    /**
     * function 物资数据详情
     * describe 物资数据详情
     * @param $id 物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:13
     */
    public function detail($id)
    {
        return $this->_materialService->detail($id);
    }

    /**
     * function 物资数据列表
     * describe 物资数据列表
     * @param Request $request 包含$page,$page_size
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:15
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_materialService->list($page, $page_size);
    }

    /**
     * function 物资数据删除
     * describe 物资数据删除
     * @param $id 物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:21
     */
    public function delete($id)
    {
        return $this->_materialService->delete($id);
    }

    /**
     * function 物资数据批量删除
     * describe 物资数据批量删除
     * @param MaterialRequest $request 多个物资项id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/11 上午11:22
     */
    public function batchDelete(MaterialRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_materialService->batchDelete($ids);
    }
}