<?php


namespace App\Http\Repository\ReportManagement;

use Excel;
use App\Enum\CodeEnum;
use App\Model\WaitingCharges;
use Illuminate\Support\Facades\DB;

class WaitingChargesRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'waiting_charges_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    public function list($page, $page_size)
    {

        return WaitingCharges::query()->paginate($page_size);
    }

    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)) {
            //
            $query = WaitingCharges::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return WaitingCharges::query()->where('id', $id)->delete();
    }

    public function batchDelete($ids)
    {
        return WaitingCharges::query()->whereIn('id', $ids)->delete();
    }

    private function cleanCache($id)
    {
        $keys = $this->_redis->keys(self::CACHE_KEY_RULE_PRE . $id);
        // 缓存也删除
        if ($keys) {
            $this->_redis->del($keys);
        }
    }

    public function search($search_index,$content)
    {
        return DB::select("select * from waiting_charges where $search_index like '%$content%' ");
    }

    public function excelExport()
    {
        $data = WaitingCharges::query()->get()->toArray();

        return Excel::create('待收费报表导出', function($excel) use ($data) {
            $excel->sheet('待收费报表导出', function($sheet) use ($data)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('床位编号');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('姓名');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('收款日期');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('收款日期');   });
                $sheet->cell('E1', function($cell) {$cell->setValue('床位费'); });
                $sheet->cell('F1', function($cell) {$cell->setValue('护理费'); });
                $sheet->cell('G1', function($cell) {$cell->setValue('抵长护险'); });
                $sheet->cell('H1', function($cell) {$cell->setValue('伙食费'); });
                $sheet->cell('I1', function($cell) {$cell->setValue('押金'); });
                $sheet->cell('J1', function($cell) {$cell->setValue('杂费'); });
                $sheet->cell('K1', function($cell) {$cell->setValue('一次性'); });
                $sheet->cell('L1', function($cell) {$cell->setValue('发票号'); });
                $sheet->cell('M1', function($cell) {$cell->setValue('开票费用'); });
                $sheet->cell('N1', function($cell) {$cell->setValue('合计费用'); });
                $sheet->cell('O1', function($cell) {$cell->setValue('备注'); });
                $sheet->cell('P1', function($cell) {$cell->setValue('收款状态'); });
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value['bed_number']);
                        $sheet->cell('B'.$i, $value['member_name']);
                        $sheet->cell('C'.$i, $value['charges_time']);
                        $sheet->cell('D'.$i, $value['refund_time']);
                        $sheet->cell('E'.$i, $value['beds_cost']);
                        $sheet->cell('F'.$i, $value['nursing_cost']);
                        $sheet->cell('G'.$i, $value['risk_insurance']);
                        $sheet->cell('H'.$i, $value['meal_cost']);
                        $sheet->cell('I'.$i, $value['deposit']);
                        $sheet->cell('J'.$i, $value['incidental']);
                        $sheet->cell('K'.$i, $value['other_cost']);
                        $sheet->cell('L'.$i, $value['invoice_number']);
                        $sheet->cell('M'.$i, $value['invoice_expenses']);
                        $sheet->cell('N'.$i, $value['total_expenses']);
                        $sheet->cell('O'.$i, $value['mark']);
                        $sheet->cell('P'.$i, CodeEnum::IS_CHARGES[$value['is_ charges']]);
                    }
                }
            });
        })->download('xls');
    }

    public function receiptOrRefund($id,$amount,$time)
    {
        $waitingChargesItem = WaitingCharges::query()->where(['id'=>$id])->first();
        if ($amount>=0){
            //amount大于0，为收款，合计金额减去收款金额
            return WaitingCharges::query()->updateOrCreate(['id'=>$id],['charges_time'=>$time,'total_expenses'=>$waitingChargesItem['total_expenses']-$amount]);
        }else{
            //amount小于0，为退款，合计金额加上退款金额
            return WaitingCharges::query()->updateOrCreate(['id'=>$id],['refund_time'=>$time,'total_expenses'=>$waitingChargesItem['total_expenses']-$amount]);
        }
    }
}