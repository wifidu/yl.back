<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookBed extends Model
{
    use SoftDeletes;

    protected $table = 'bed_information';

    /**
     * 需要被转换成日期的属性。
     * 删除日期
     * @var array
     */
    protected $dates = ['deleted_at'];

    public $timestamps = true;

    protected $fillable = [
        'bed_number',       // 预约床位 (必填)
        'bed_cost',         // 床位费用 (必填)
        'check-in_date',    // 入住日期 (必填)
        'appoint_deposit',  // 预付押金
        'contract_number',  // 联系电话 (必填)
        'appoint_person',   // 预约人 (必填)
        'appoint_time',     // 预约时间
        'elderly_name',     // 老人姓名 (必填)
        'elderly_ID',       // 老人身份证号
        'elderly_age',      // 老人年龄
        'elderly_gender',   // 老人姓名 0-男 1-女 (必填)
        'self-care_ability',// 老人自理能力 (必填)
        'address',          // 居住地址
        'remark',           // 备注 ( 必填 )
    ];

}
