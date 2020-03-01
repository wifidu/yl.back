<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FoodManage extends Model
{
    protected $table = 'food_management';

    public $timestamps = true;

    protected $fillable = [
        'food_name',             //单品名称
        'food_price',            //单品价格
        'food_type',             //单品状态
        'subordinate_species',   //所属种类
    ];
}