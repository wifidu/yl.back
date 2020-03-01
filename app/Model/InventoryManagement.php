<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InventoryManagement extends Model
{
    protected $table='inventory_management';

    public $timestamps = true;

    protected $fillable = [
        'inventory_time',               //盘点时间
        'name',                         //盘点名称
        'number',                       //盘点数量
        'total',                        //合计金额
        'inventory_losses',             //盘亏
        'inventory_surplus',            //盘盈
        'check_person',                 //盘点人
        'completion_time',              //完成时间
    ];
}
