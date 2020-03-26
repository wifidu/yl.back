<?php


namespace App\Http\Service\ReportManagement;

use App\Http\Repository\ReportManagement\WaitingChargesRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;

class WaitingChargesService
{
    use ApiTraits;
    private $_waitingChargesRepository;

    public function __construct(WaitingChargesRepository $waitingChargesRepository)
    {
        $this->_waitingChargesRepository = $waitingChargesRepository;
    }

    public function detail($id)
    {
        $data = $this->_waitingChargesRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    public function list($page, $page_size)
    {
        $data = $this->_waitingChargesRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    public function delete($id)
    {
        $result = $this->_waitingChargesRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_waitingChargesRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    public function batchDelete($ids)
    {
        $this->_waitingChargesRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    public function search($search_index,$content)
    {
        $search = $this->_waitingChargesRepository->search($search_index,$content);
        return $this->apiReturn($search,CodeEnum::SUCCESS);
    }

    public function excelExport()
    {
        return $this->_waitingChargesRepository->excelExport();
    }

    public function receiptOrRefund($id,$amount,$time)
    {
        $data = $this->_waitingChargesRepository->receiptOrRefund($id,$amount,$time);
        if ($data){
            return $this->apiReturn($data,CodeEnum::SUCCESS);
        }
        return $this->apiReturn('',CodeEnum::FAIL);
    }
}