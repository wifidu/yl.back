<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DeliveryManage extends Model
{
    protected $table = 'delivery_management';

    public $timestamps = true;

    protected $fillable = [
        'member_name',          //会员名称
        'bed_name',             //床位名称
        'eat_time',             //就餐时间
        'meal_times',           //餐次名称
        'dishes_name',          //菜品名称
        'dining_style',         //就餐方式(0-送餐 1-自取)
        'type',                 //状态(0-未就餐 1-配送中 2-已就餐)

    ];

}