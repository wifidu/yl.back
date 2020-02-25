<?php


namespace App\Http\Service\PersonnelManage;

use App\Http\Repository\PersonnelManage\TeamManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class TeamManageService
{
    use ApiTraits;
    private $_teamManageRepository;

    public function __construct(TeamManageRepository $TeamManageRepository)
    {
        $this->_teamManageRepository = $TeamManageRepository;
    }

    /**
     * function 新增、编辑团队信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:54
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_teamManageRepository->store($params);
        if ($id) {
            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 团队详情
     * describe 查看团队信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:54
     */
    public function detail($id)
    {
        $data = $this->_teamManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 团队删除
     * describe 删除团队信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:54
     */
    public function delete($id)
    {
        $result = $this->_teamManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_teamManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 团队数据列表
     * describe 团队数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:55
     */
    public function list($page, $page_size)
    {
        $data = $this->_teamManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 员工数据批量删除
     * describe 员工数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-02-23 19:56
     */
    public function batchDelete($ids)
    {
        $this->_teamManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}