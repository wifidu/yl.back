<?php


namespace App\Http\Controllers\Api\MedicineManage;


use App\Http\Requests\Api\MedicineManage\MedicineDepositRequest;
use App\Http\Service\MedicineManage\MedicineDepositService;
use Dingo\Api\Http\Request;

class MedicineDepositController
{
    private MedicineDepositService $_drugInformation;
    public function __construct(MedicineDepositService $MedicineDepositService)
    {
        $this->_drugInformation = $MedicineDepositService;
    }

    /**
     * 新增或修改相关信息
     * @param  $request
     * @return array
     */
    public function store(MedicineDepositRequest $request)
    {
        $params = $request->post();
        return $this->_drugInformation->store($params);
    }

    /**
     * 详情
     * @param $id
     * @return array
     */
    public function detail($id)
    {
        return $this->_drugInformation->detail($id);
    }

    /**
     * 分页显示
     * @param Request $request
     * @return array
     */
    public function list(Request $request)
    {
        $page_size = $request->page_size ?? 25;
        return $this->_drugInformation->list($page_size);
    }

    /**
     * 删除记录
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        return $this->_drugInformation->delete($id);
    }

    /**
     * 搜索
     * @param MedicineDepositRequest $request
     * @return array
     */
    public function search(MedicineDepositRequest $request)
    {
        $params = $request->get('member_name');
        return $this->_drugInformation->search($params);
    }

    /**
     * 批量删除
     * @param MedicineDepositRequest $request
     * @return array
     */
    public function batchDelete(MedicineDepositRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_drugInformation->batchDelete($ids);
    }

}