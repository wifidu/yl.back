<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class DepartmentManage extends Model
{
    protected $table = 'department_management';

    public $timestamps = true;

    protected $fillable = [
        'department_name',             //部门名称
        'department_description',      //部门描述

    ];
}