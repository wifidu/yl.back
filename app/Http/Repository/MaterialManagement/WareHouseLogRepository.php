<?php


namespace App\Http\Repository\MaterialManagement;

use Excel;
use App\Enum\CodeEnum;
use App\Model\WareHouseLog;
use Illuminate\Support\Facades\DB;

class WareHouseLogRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'ware_house_log_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    /**
     * function 仓库日志数据列表
     * describe 仓库日志数据列表
     * @param $page 当前页数
     * @param $page_size 页面数据大小
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:07
     */
    public function list($page, $page_size)
    {
        return WareHouseLog::query()->with([ 'materialIn', 'materialOut', 'material' ])->paginate($page_size);
    }

    /**
     * function 仓库日志-数据详情
     * describe 仓库日志-数据详情
     * @param $id 仓库日志id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|mixed|object|null
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:09
     */
    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)) {
            //
            $query = WareHouseLog::query()->where(['id' => $id])->with([ 'materialIn', 'materialOut', 'material' ])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    /**
     * function 仓库日志数据删除
     * describe 仓库日志数据删除
     * @param $id
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:06
     */
    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return WareHouseLog::query()->where('id', $id)->delete();
    }

    /**
     * function 仓库日志数据批量删除
     * describe 仓库日志数据批量删除
     * @param $ids
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:06
     */
    public function batchDelete($ids)
    {
        return WareHouseLog::query()->whereIn('id', $ids)->delete();
    }

    /**
     * function 清除缓存
     * describe 清除缓存
     * @param $id 仓库日志id
     * @author ZhaoDaYuan
     * 2020/3/6 上午11:05
     */
    private function cleanCache($id)
    {
        $keys = $this->_redis->keys(self::CACHE_KEY_RULE_PRE . $id);
        // 缓存也删除
        if ($keys) {
            $this->_redis->del($keys);
        }
    }

    public function search($page, $page_size, $warehouse_name = '', $start_time = '', $end_time = '')
    {
        $query = WareHouseLog::query();
        if ($warehouse_name) {
            return $query = $query->where('warehouse_name', $warehouse_name)->with([ 'materialIn', 'materialOut', 'material' ])->get();
        }
        if ($start_time) {
            $query = $query->where('created_at', '>=', $start_time);
        }
        if ($end_time) {
            $query = $query->where('created_at', '<=', $end_time);
        }

        return $query->with([ 'materialIn', 'materialOut', 'material' ])->paginate($page_size);
    }
        // switch ($warehouse_name){
        //     case 'all':
        //         switch ($operator_type){
        //             case 'all':
        //                 switch ($time_range){
        //                     case 'all':
        //                         return DB::select("select * from warehouse_log where $search_index like '%$content%' ");
        //                         break;
        //                     default:
        //                         return DB::select("select * from warehouse_log where date_add(FROM_UNIXTIME(operator_time),INTERVAL $time_range YEAR) >= now() and $search_index like '%$content%' ");
        //                         break;
        //                 }
        //                 break;
        //             default:
        //                 switch ($time_range){
        //                     case 'all':
        //                         return DB::select("select * from warehouse_log where `type`= $operator_type and $search_index like '%$content%' ");
        //                         break;
        //                     default:
        //                         return DB::select("select * from warehouse_log where date_add(FROM_UNIXTIME(operator_time),INTERVAL $time_range YEAR) >= now() and `type`= $operator_type and $search_index like '%$content%' ");
        //                         break;
        //                 }
        //                 break;
        //         }
        //     default:
        //         switch ($operator_type){
        //             case 'all':
        //                 switch ($time_range){
        //                     case 'all':
        //                         return DB::select("select * from warehouse_log where `warehouse_name`='$warehouse_name' and $search_index like '%$content%' ");
        //                         break;
        //                     default:
        //                         return DB::select("select * from warehouse_log where date_add(FROM_UNIXTIME(operator_time),INTERVAL $time_range YEAR) >= now() and `warehouse_name`='$warehouse_name' and $search_index like '%$content%' ");
        //                         break;
        //                 }
        //                 break;
        //             default:
        //                 switch ($time_range){
        //                     case 'all':
        //                         return DB::select("select * from warehouse_log where `type`= $operator_type and `warehouse_name`='$warehouse_name' and $search_index like '%$content%' ");
        //                         break;
        //                     default:
        //                         return DB::select("select * from warehouse_log where  date_add(FROM_UNIXTIME(operator_time),INTERVAL $time_range YEAR) >= now() and `type`= $operator_type and `warehouse_name`='$warehouse_name' and $search_index like '%$content%' ");
        //                         break;
        //                 }
        //                 break;
        //         }
        // }
    // }

    /**
     * function 导出仓库日志EXCELl
     * describe 导出仓库日志EXCELl
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/3/5 下午11:52
     */
    public function excelExport()
    {

        $data = WareHouseLog::query()->get()->toArray();

        return Excel::create('仓库日志导出', function($excel) use ($data) {
            $excel->sheet('仓库日志导出', function($sheet) use ($data)
            {
                $sheet->cell('A1', function($cell) {$cell->setValue('单号');   });
                $sheet->cell('B1', function($cell) {$cell->setValue('操作类型');   });
                $sheet->cell('C1', function($cell) {$cell->setValue('仓库名称');   });
                $sheet->cell('D1', function($cell) {$cell->setValue('物资名称'); });
                $sheet->cell('E1', function($cell) {$cell->setValue('物资ID'); });
                $sheet->cell('F1', function($cell) {$cell->setValue('品牌规格'); });
                $sheet->cell('G1', function($cell) {$cell->setValue('供应商'); });
                $sheet->cell('H1', function($cell) {$cell->setValue('单位'); });
                $sheet->cell('I1', function($cell) {$cell->setValue('单价'); });
                $sheet->cell('J1', function($cell) {$cell->setValue('操作数量'); });
                $sheet->cell('K1', function($cell) {$cell->setValue('金额(元)'); });
                $sheet->cell('L1', function($cell) {$cell->setValue('操作人'); });
                $sheet->cell('M1', function($cell) {$cell->setValue('变动时间'); });
                if (!empty($data)) {
                    foreach ($data as $key => $value) {
                        $i= $key+2;
                        $sheet->cell('A'.$i, $value['odd_number']);
                        $sheet->cell('B'.$i, CodeEnum::WareHouseLog[$value['type']]);
                        $sheet->cell('C'.$i, $value['warehouse_name']);
                        $sheet->cell('D'.$i, $value['material_name']);
                        $sheet->cell('E'.$i, $value['material_id']);
                        $sheet->cell('F'.$i, $value['brand']);
                        $sheet->cell('G'.$i, $value['supplier']);
                        $sheet->cell('H'.$i, CodeEnum::UNIT[$value['unit']]);
                        $sheet->cell('I'.$i, $value['price']);
                        $sheet->cell('J'.$i, $value['number']);
                        $sheet->cell('K'.$i, $value['total']);
                        $sheet->cell('L'.$i, $value['operator']);
                        $sheet->cell('M'.$i, Date('Y-m-d h:i:s',$value['operator_time']));
                    }
                }
            });
        })->download('xls');
    }
}
