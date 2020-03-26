<?php


namespace App\Http\Service\ReportManagement;

use App\Http\Repository\ReportManagement\monthlyChargesRepository;
use App\Traits\ApiTraits;
use App\Enum\CodeEnum;
use SebastianBergmann\Environment\Console;

class MonthlyChargesService
{
    use ApiTraits;
    private $_monthlyChargesRepository;

    public function __construct(monthlyChargesRepository $monthlyChargesRepository)
    {
        $this->_monthlyChargesRepository = $monthlyChargesRepository;
    }

    public function detail($id)
    {
        $data = $this->_monthlyChargesRepository->item($id);

        if ($data) {
            return $this->apiReturn($data, CodeEnum::SUCCESS);
        }

        return $this->apiReturn('', CodeEnum::NON_EXISTENT);
    }

    public function list($page, $page_size)
    {
        $data = $this->_monthlyChargesRepository->list($page, $page_size);
        return $this->apiReturn($data, CodeEnum::SUCCESS);
    }

    public function delete($id)
    {
        $result = $this->_monthlyChargesRepository->item($id);
        if (!$result) {
            return $this->apiReturn('', CodeEnum::NON_EXISTENT);
        }
        $this->_monthlyChargesRepository->delete($id);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    public function batchDelete($ids)
    {
        $this->_monthlyChargesRepository->batchDelete($ids);

        return $this->apiReturn('', CodeEnum::SUCCESS);
    }

    public function search($time_type,$time_range)
    {
        $search = $this->_monthlyChargesRepository->search($time_type,$time_range);
        if (isset($GLOBALS['monthly_charges_search_error'])&&$GLOBALS['monthly_charges_search_error']==true){
            return $this->apiReturn('',CodeEnum::PARAMES_ERROR);
        }
        return $this->apiReturn($search,CodeEnum::SUCCESS);
    }

    public function excelExport()
    {
        return $this->_monthlyChargesRepository->excelExport();
    }
}