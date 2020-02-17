<?php


namespace App\Http\Service\PersonnelManage;

use App\Http\Repository\PersonnelManage\StaffManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class StaffManageService
{
    use ApiTraits;
    private $_staffManageRepository;

    public function __construct(StaffManageRepository $StaffManageRepository)
    {
        $this->_staffManageRepository = $StaffManageRepository;
    }

    /**
     * function 新增、编辑员工信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:49
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_staffManageRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 员工详情
     * describe 查看员工信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:50
     */
    public function detail($id)
    {
        $data = $this->_staffManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 员工删除
     * describe 删除员工信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:50
     */
    public function delete($id)
    {
        $result = $this->_staffManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_staffManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 员工数据列表
     * describe 员工数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:50
     */
    public function list($page, $page_size)
    {
        $data = $this->_staffManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 员工数据批量删除
     * describe 员工数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-2-17 17:51
     */
    public function batchDelete($ids)
    {
        $this->_staffManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}