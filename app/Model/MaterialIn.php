<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MaterialIn extends Model
{
    protected $table = 'material_in';

    public $timestamps = true;

    protected $fillable = [
        'warehouse_name',       //仓库名称
        'origin',               //来源
        'batch_number',         //批号
        'in_time',              //入库时间
        'operator',             //操作人
        'remarks',              //备注
        'in_material',          //入库清单
    ];

    public function setInMaterialAttribute($value) {
        $this->attributes['in_material'] = json_encode($value);
    }

//    public function getInMaterialAttribute($value) {
//        $this->attributes['in_material'] = json_decode($value);
//    }
}
