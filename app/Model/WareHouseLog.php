<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class WareHouseLog extends Model
{
    protected $table='warehouse_log';

    public $timestamps = true;

    protected $fillable = [
        // 'odd_number',               //单号
        'type',                     //操作类型
        'warehouse_name',           //仓库名称
        // 'material_name',            //物资名称
        'material_id',              //物资id
        'in_id',
        'out_id',
        // 'brand',                    //品牌规格
        // 'supplier',                 //供应商
        // 'unit',                     //单位
        // 'price',                    //单价
        // 'number',                   //操作数量
        // 'total',                    //金额
        // 'operator',                 //操作人
        // 'operator_time',            //变动时间
    ];

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function materialIn()
    {
        return $this->belongsTo(MaterialIn::class, 'in_id');
    }

    public function materialOut()
    {
        return $this->belongsTo(MaterialOut::class, 'out_id');
    }
}
