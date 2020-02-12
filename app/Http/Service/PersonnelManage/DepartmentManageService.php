<?php


namespace App\Http\Service\PersonnelManage;

use App\Http\Repository\PersonnelManage\DepartmentManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class DepartmentManageService
{
    use ApiTraits;
    private $_departmentManageRepository;

    public function __construct(DepartmentManageRepository $DepartmentManageRepository)
    {
        $this->_departmentManageRepository = $DepartmentManageRepository;
    }

    /**
     * function 新增、编辑部门信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-2-5 15:53
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_departmentManageRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 部门详情
     * describe 查看部门信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-5 15:53
     */
    public function detail($id)
    {
        $data = $this->_departmentManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 部门删除
     * describe 删除部门信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-5 15:54
     */
    public function delete($id)
    {
        $result = $this->_departmentManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_departmentManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 部门数据列表
     * describe 部门数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-2-5 16:31
     */
    public function list($page, $page_size)
    {
        $data = $this->_departmentManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 部门数据批量删除
     * describe 部门数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-2-5 16:32
     */
    public function batchDelete($ids)
    {
        $this->_departmentManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}