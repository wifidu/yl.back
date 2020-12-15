<?php

namespace App\Listeners;

use App\Model\Material;
use App\Model\WareHouseLog;
use Log;
use App\Events\WarehouseLog as WareHouseLogEvent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Model\WareHouseLog as WareHouseLogModel;

class WarehouseLogListener implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param  WarehouseLog  $event
     * @return void
     */
    public function handle(WareHouseLogEvent $event)
    {
        $params = $event->_warehousedata;
        $data['type'] = isset($params['in_number']) ? 2 : 1;
        $data['material_id'] = $params['material_id'];
        $data['warehouse_name'] = $params['warehouse_name'];

        if ($data['type'] == 2) {
            $data['in_id'] = $params['id'];
        } else {
            $data['out_id'] = $params['id'];
        }
        // var_dump($data);
        WareHouseLogModel::create($data);
        // $type = $params['type'] ?? substr($data['odd_number'],0,2);
        // if ($type=='CK'){
        //     $data['type'] = 1;
        //     $material_detail = $params['out_material'];
        // }elseif ($type=='RK'){
        //     $data['type'] = 2;
        //     $material_detail = $params['in_material'];
        // }else{
        //     $data['type'] = 0;
        //     $material_detail = json_decode($params['material_detail']);
        // }
        // $material_all = Material::all();
        //
        // foreach ($material_all as $item){
        //     $material[$item->id] = $item;
        // }
        //
        // $material_id = !is_object($material_detail) ? $material_detail['material_id'] : $material_detail->material_id;
        // $data['warehouse_name'] = $params['warehouse_name'];
        // $data['material_name']  = $material[$material_id]->name;
        // $data['material_id']    = 123;
        // $data['brand']          = $material[$material_id]->brand;
        // $data['supplier']       = !is_object($material_detail) ? $material_detail['supplier'] : $material_detail->supplier;
        // $data['unit']           = $material[$material_id]->unit;
        // $data['price']          = !is_object($material_detail) ? $material_detail['price'] : $material_detail->price;
        // $data['number']         = !is_object($material_detail) ? $material_detail['number'] : $material_detail->number;
        // $data['total']          = $data['price']*$data['number'];
        // $data['operator']       = $params['operator'];
        // $data['operator_time']  = time();
        //
        // WareHouseLogModel::query()->Create($data);
    }
}
