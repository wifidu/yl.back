<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PositionManage extends Model
{
    protected $table = 'position_management';

    public $timestamps = true;

    protected $fillable = [
        'department_name',             //部门名称
        'department_description',      //部门描述
        'position_name',	           //岗位名称
        'position_type',	           //岗位类型(0-行政岗1-财务岗2-护理岗3-管理岗)
        'position_salary',             //岗位薪水(元/每单)
        'rank_name',	               //职级名称
        'rank_salary',                 //职级薪水(元/每单)
        'position_description',	       //岗位描述
        'role_id',                     //角色id

    ];
}