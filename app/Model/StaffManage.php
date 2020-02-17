<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class StaffManage extends Model
{
    protected $table = 'staff_management';

    public $timestamps = true;

    protected $fillable = [
        'staff_name',	                //员工姓名
        'sex',	                        //性别(0-男 1-女)
        'id_number',	                //身份证号
        'birth_date',	                //出生日期
        'subordinate_department',	    //所属部门
        'subordinate_team',	            //所属团队
        'nation',	                    //民族
        'position_rank',	            //岗位职级
        'phone_number',             	//手机号
        'staff_type',	                //员工类型(0-劳动合同工 1-临时工)
        'start_time',	                //合同起始时间
        'end_time',	                    //合同截止时间
        'staff_status',	                //员工状态(0-在职 1-离职)
        'bank',                     	//开户行
        'bank_card_number',	            //银行卡号


    ];
}