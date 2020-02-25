<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TeamManage extends Model
{
    protected $table = 'team_management';

    public $timestamps = true;

    protected $fillable = [
        'team_name',	                 //团队名称
        'service_type',	                 //服务类型
        'team_description',             //工作描述
        'team_members',	                //团队成员
        'header',	                    //负责人
        'bed_assignment',	            //床位分配

    ];
}