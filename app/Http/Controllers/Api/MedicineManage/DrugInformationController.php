<?php


namespace App\Http\Controllers\Api\MedicineManage;


use App\Http\Controllers\Controller;
use App\Http\Requests\Api\MedicineManage\DrugInformationRequest;
use App\Http\Service\MedicineManage\DrugInformationService;
use Dingo\Api\Http\Request;

class DrugInformationController extends Controller
{
    private $_drugInformation;
    public function __construct(DrugInformationService $drugInformationService)
    {
        $this->_drugInformation = $drugInformationService;
    }

    /**
     * 新增或修改相关信息
     * @param DrugInformationRequest $request
     * @return array
     */
    public function store(DrugInformationRequest $request)
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
     * @param DrugInformationRequest $request
     * @return array
     */
    public function search(DrugInformationRequest $request)
    {
        $params = $request->get('drug_name');
        return $this->_drugInformation->search($params);
    }

    /**
     * 批量删除
     * @param DrugInformationRequest $request
     * @return array
     */
    public function batchDelete(DrugInformationRequest $request)
    {
        $params = $request->all();
        $ids    = $params['ids'];
        return $this->_drugInformation->batchDelete($ids);
    }

    
}