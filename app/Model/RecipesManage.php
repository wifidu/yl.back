<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RecipesManage extends Model
{
    protected $table = 'recipes_management';

    public $timestamps = true;

    protected $fillable = [
        'weekly',                   //周次
        'package_name',             //套餐名称
        'package_detail',           //套餐详情

    ];

    public function setPackageDetailAttribute($value) {
        $this->attributes['package_detail'] = json_encode($value);
    }
}