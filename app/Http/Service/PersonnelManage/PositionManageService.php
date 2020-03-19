<?php


namespace App\Http\Service\PersonnelManage;

use App\Events\PositionManage;
use App\Http\Repository\PersonnelManage\PositionManageRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use Log;

class PositionManageService
{
    use ApiTraits;
    private $_positionManageRepository;

    public function __construct(PositionManageRepository $PositionManageRepository)
    {
        $this->_positionManageRepository = $PositionManageRepository;
    }

    /**
     * function 新增,编辑职位信息
     * describe 新增的id自增，编辑中的数据中需要包含编辑的id
     * @param $params
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:17
     */
    public function store($params)
    {
        Log::info(json_encode($params, JSON_UNESCAPED_UNICODE));

        $id = $this->_positionManageRepository->store($params);
        if ($id) {
            event(new PositionManage($params));

            return $this->apiReturn(['id' => $id], CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::FAIL);
    }

    /**
     * function 职位详情
     * describe 查看职位信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:17
     */
    public function detail($id)
    {
        $data = $this->_positionManageRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    /**
     * function 职位删除
     * describe 删除职位信息
     * @param $id
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:18
     */
    public function delete($id)
    {
        $result = $this->_positionManageRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_positionManageRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    /**
     * function 职位数据列表
     * describe 职位数据列表
     * @param $page
     * @param $page_size
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:18
     */
    public function list($page, $page_size)
    {
        $data = $this->_positionManageRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    /**
     * function 职位数据批量删除
     * describe 职位数据批量删除
     * @param $ids
     * @return array
     * @author kfccPeng
     * 2020-2-11 18:18
     */
    public function batchDelete($ids)
    {
        $this->_positionManageRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }
}