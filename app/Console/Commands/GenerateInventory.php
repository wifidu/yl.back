<?php

namespace App\Console\Commands;

use App\Events\WarehouseLog;
use App\Model\MaterialIn;
use App\Model\MaterialOut;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Model\InventoryManagement;

class GenerateInventory extends Command
{
    protected $signature = 'p_o:generate-inventory';

    protected $description = '生成每月盘点信息';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
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
        unset($data);

        foreach ($inventory_detail as $item) {
            $from    = substr($item->operator_number,0,2);
            if ($from=='CK'){
                $detail = MaterialOut::query()->updateOrCreate(['out_number'=>$item->operator_number],['inventory_id'=>$inventory->id]);
                $data['warehouse_name']     = $detail['warehouse_name'];
                $data['material_detail']    = $detail['out_material'];
                $data['operator']           = $detail['operator'];
                $data['odd_number']         = $name;
                $data['type']               = 'PD';
                event(new WarehouseLog($data));
            }else{
                $detail = MaterialIn::query()->updateOrCreate(['in_number'=>$item->operator_number],['inventory_id'=>$inventory->id]);
                $data['warehouse_name']     = $detail['warehouse_name'];
                $data['material_detail']    = $detail['in_material'];
                $data['operator']           = $detail['operator'];
                $data['odd_number']         = $name;
                $data['type']               = 'PD';
                event(new WarehouseLog($data));
            }
        }
    }
}
