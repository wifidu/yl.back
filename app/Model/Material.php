<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $table = 'material';

    public $timestamps = true;

    protected $fillable = [
        'name',             //物资名称
        'brand',            //品牌
        'model',            //型号
        'unit',             //入库单位
        'supplier',         //供应商
        'price',            //价格
        'number',           //数量
    ];
}
