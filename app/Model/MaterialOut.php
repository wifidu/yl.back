<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaterialOut extends Model
{
    protected $table = 'material_out';

    public $timestamps = true;

    protected $fillable = [
        'warehouse_name',       //仓库名称
        'out_number',           //出库单号
        'whereabouts',          //去向
        'user',                 //领用人
        'out_time',             //出库时间
        'operator',             //操作人
        'remarks',              //备注
        'out_material',         //出库清单
        'inventory_id',         //盘点id
        'amount'
    ];

    public function setOutMaterialAttribute($value) {
        $this->attributes['out_material'] = json_encode($value);
    }

    public function material()
    {
        return $this->belongsTo(Material::class);
    }

    public function wareHouseLog()
    {
        return $this->hasOne(WareHouseLog::class, 'out_id');
    }
}
