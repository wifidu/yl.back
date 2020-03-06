<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PackageManage extends Model
{
    protected $table = 'package_management';

    public $timestamps = true;

    protected $fillable = [
        'package_name',             //套餐名称
        'package_price',            //套餐价格
        'reserve_number',           //订餐人数
        'package_describe',	         //套餐描述

    ];
}