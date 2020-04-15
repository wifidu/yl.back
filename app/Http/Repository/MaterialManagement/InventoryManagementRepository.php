<?php


namespace App\Http\Repository\MaterialManagement;

use App\Model\InventoryManagement;
use App\Model\MaterialOut;
use App\Model\MaterialIn;
use App\Model\Material;
use Illuminate\Support\Facades\DB;

class InventoryManagementRepository
{
    private $_redis;

    const CACHE_KEY_RULE_PRE = 'inventory_management_';

    public function __construct()
    {
        $this->_redis = app('redis');
    }

    public function store($params)
    {
        $id                         = $params['id'] ?? '';
        $params['completion_time']  = time();

        return InventoryManagement::query()->updateOrCreate(['id' => $id], $params);
    }

    public function item($id)
    {
        //查询缓存
        $cache = json_decode($this->_redis->get(self::CACHE_KEY_RULE_PRE . $id));

        //缓存为空则查询数据库并将数据存入缓存
        if (empty($cache)){
            //
            $query = InventoryManagement::query()->where(['id' => $id])->first();
            $this->_redis->set(self::CACHE_KEY_RULE_PRE . $id, $query);

            return $query;
        }

        return $cache;
    }

    public function list($page, $page_size)
    {

        return InventoryManagement::query()->paginate($page_size);
    }

    public function delete($id)
    {
        //清除缓存
        $this->cleanCache($id);

        return InventoryManagement::query()->where('id', $id)->delete();
    }

    public function batchDelete($ids)
    {
        return InventoryManagement::query()->whereIn('id', $ids)->delete();
    }

    private function cleanCache($id)
    {
        $keys = $this->_redis->keys(self::CACHE_KEY_RULE_PRE . $id);
        // 缓存也删除
        if ($keys) {
            $this->_redis->del($keys);
        }
    }

    /**
     * function 生成上月盘点数据
     * describe 生成上月盘点数据
     * @author ZhaoDaYuan
     * 2020/3/1 上午11:53
     */
    public function generate()
    {
        $inventory_time = time();
        $name = date('m', time()) . "月份盘点";
        $inventory_detail = DB::select("
             select i.warehouse_name as warehouse_name,
                    i.in_number as operator_number,
                    i.in_material as material_detail,
                    i.operator as operator,
                    i.in_time as time 
             from   material_in as i 
             where  PERIOD_DIFF(date_format(now(), '%Y%m'), date_format(i.created_at, '%Y%m')) = 1 
             union all select 
                    o.warehouse_name as warehouse_name,
                    o.out_number as operator_number,
                    o.out_material as material_detail,
                    o.operator as operator,
                    o.out_time as time 
             from   material_out as o 
             where  PERIOD_DIFF(date_format(now(), '%Y%m'), date_format(o.created_at, '%Y%m')) = 1 
             order by time asc
            ");
        $number = 0;
        $total  = 0;
        foreach ($inventory_detail as $item) {
            $detail  = json_decode($item->material_detail);
            $number += $detail->number;
            $total  += $detail->number * $detail->price;
        }
        $data['inventory_time']     =   $inventory_time;
        $data['name']               =   $name;
        $data['number']             =   $number;
        $data['total']              =   $total;
        $inventory                  =   InventoryManagement::query()->create($data);

        foreach ($inventory_detail as $item) {
            $from    = substr($item->operator_number,0,2);
            if ($from=='CK'){
                MaterialOut::query()->updateOrCreate(['out_number'=>$item->operator_number],['inventory_id'=>$inventory->id]);
            }else{
                MaterialIn::query()->updateOrCreate(['in_number'=>$item->operator_number],['inventory_id'=>$inventory->id]);
            }
        }
    }

    /**
     * function 盘点管理-盘点详情
     * describe 盘点管理-盘点详情
     * @param $id 盘点id
     * @return mixed
     * @author ZhaoDaYuan
     * 2020/3/1 下午1:44
     */
    public function inventoryDetail($id)
    {
        $inventory_detail = DB::select("
             select i.warehouse_name as warehouse_name,
                    i.in_number as operator_number,
                    i.in_material as material_detail,
                    i.operator as operator,
                    i.in_time as time 
             from   material_in as i 
             where  inventory_id = $id
             union all select 
                    o.warehouse_name as warehouse_name,
                    o.out_number as operator_number,
                    o.out_material as material_detail,
                    o.operator as operator,
                    o.out_time as time 
             from   material_out as o 
             where  inventory_id = $id 
             order by time asc
            ");

        $material_all = Material::all();

        foreach ($material_all as $item){
            $material[$item->id] = $item;
        }

        foreach ($inventory_detail as $key=>$value) {
            $detail  = json_decode($value->material_detail);
            $inventory_detail[$key]->number     = $detail->number;
            $inventory_detail[$key]->price      = $detail->price;
            $inventory_detail[$key]->supplier   = $detail->supplier;
            $inventory_detail[$key]->name   = $material[$detail->material_id]->name;
            $inventory_detail[$key]->unit   = $material[$detail->material_id]->unit;
            unset($inventory_detail[$key]->material_detail);
            $from    = substr($value->operator_number,0,2);
            if ($from=='CK'){
                $inventory_detail[$key]->operator_type   = "出库";
            }else{
                $inventory_detail[$key]->operator_type   = "入库";
            }
        }

        return $inventory_detail;
    }

    public function search($search_index,$time_range,$content)
    {
        if ($content==''){
            return DB::select("select * from inventory_management");
        }
        if ($time_range=='all'){
            return DB::select("select * from inventory_management where $search_index like '%$content%'");
        }else{
            return DB::select("select * from inventory_management where date_add(FROM_UNIXTIME(inventory_time),INTERVAL $time_range YEAR) >= now() and $search_index like '%$content%' ");
        }
    }
}