<?php


namespace App\Http\Controllers\Api\DietManage;

use App\Http\Service\DietManage\DeliveryManageService;
use App\Http\Requests\Api\DietManage\DeliveryManageRequest;
use Dingo\Api\Contract\Http\Request;


class DeliveryManageController
{
    private $_deliveryManageService;

    public function __construct(DeliveryManageService $DeliveryManageService)
    {
        $this->_deliveryManageService = $DeliveryManageService;
    }

    /**
     * function 新增、编辑配送信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param DeliveryManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:22
     */
    public function store(DeliveryManageRequest $request)
    {
        $params = $request->post();
        return $this->_deliveryManageService->store($params);
    }

    /**
     * function 配送详情
     * describe 查看配送信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:22
     */
    public function detail($id)
    {
        return $this->_deliveryManageService->detail($id);
    }

    /**
     * function 配送删除
     * describe 删除配送信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:22
     */
    public function delete($id)
    {
        return $this->_deliveryManageService->delete($id);
    }

    /**
     * function 配送数据列表
     * describe 配送数据列表
     * @param Request $request
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:23
     */
    public function list(Request $request)
    {
        $page      = $request->page ?? 1;
        $page_size = $request->page_size ?? 20;
        return $this->_deliveryManageService->list($page, $page_size);
    }

    /**
     * function 配送数据批量删除
     * describe 配送数据批量删除
     * @param DeliveryManageRequest $request
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:23
     */
    public function batchDelete(DeliveryManageRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_deliveryManageService->batchDelete($ids);
    }

    /**
     * function 配送
     * describe 配送
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-03-22 18:23
     */
    public function delivery($id)
    {
        return $this->_deliveryManageService->delivery($id);
    }
}
