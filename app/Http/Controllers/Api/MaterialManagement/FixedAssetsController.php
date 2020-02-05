<?php


namespace App\Http\Controllers\Api\MaterialManagement;

use App\Http\Service\FixedAssets\FixedAssetsService;
use App\Http\Requests\Api\MaterialManagement\FixedAssetsRequest;
use Dingo\Api\Contract\Http\Request;


class FixedAssetsController
{
    private $_fixedAssetsService;

    public function __construct(FixedAssetsService $fixedAssetsService)
    {
        $this->_fixedAssetsService = $fixedAssetsService;
    }

    /**
     * function 固定资产数据存储或更新
     * describe 固定资产数据存储或更新
     * @param FixedAssetsRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:21
     */
    public function store(FixedAssetsRequest $request)
    {
        $params = $request->post();
        return $this->_fixedAssetsService->store($params);
    }

    /**
     * function 固定资产数据详情
     * describe 固定资产数据详情
     * @param $id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:21
     */
    public function detail($id)
    {
        return $this->_fixedAssetsService->detail($id);
    }

    /**
     * function 固定资产数据列表
     * describe 固定资产数据列表
     * @param Request $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:20
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_fixedAssetsService->list($page, $page_size);
    }

    /**
     * function 固定资产数据删除
     * describe 固定资产数据删除
     * @param $id
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:24
     */
    public function delete($id)
    {
        return $this->_fixedAssetsService->delete($id);
    }

    /**
     * function 固定资产数据批量删除
     * describe 固定资产数据批量删除
     * @param FixedAssetsRequest $request
     * @return array
     * @author ZhaoDaYuan
     * 2020/2/3 下午5:27
     */
    public function batchDelete(FixedAssetsRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_fixedAssetsService->batchDelete($ids);
    }
}