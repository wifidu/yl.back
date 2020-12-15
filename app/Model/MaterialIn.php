<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaterialIn extends Model
{
    protected $table = 'material_in';

    public $timestamps = true;

    protected $fillable = [
        'material_id',
        'warehouse_name',       //仓库名称
        'in_number',            //入库单号
        'origin',               //来源
        'batch_number',         //批号
        'in_time',              //入库时间
        'operator',             //操作人
        'remarks',              //备注
        'in_material',          //入库清单
        'inventory_id',         //盘点id
        'amount'
    ];

    public function setInMaterialAttribute($value) {
        $this->attributes['in_material'] = json_encode($value);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function wareHouseLog()
    {
        return $this->hasOne(WareHouseLog::class, 'in_id');
    }
}
