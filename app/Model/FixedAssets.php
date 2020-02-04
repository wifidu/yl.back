<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class FixedAssets extends Model
{
    protected $table = 'fixed_assets';

    public $timestamps = true;

    protected $fillable = [
        'name',             //资产名称
        'classification',   //分类
        'serial_number',    //序列号
        'brand',            //品牌
        'position',         //位置
        'model',            //型号
        'department',       //部门
        'administrators',   //负责人
        'price',            //金额
        'type',             //状态
        'install_date',     //安装时间
        'warranty',         //报修期
        'remarks',          //备注
        'picture_url',      //图片URL

    ];
}
