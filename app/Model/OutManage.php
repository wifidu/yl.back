<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OutManage extends Model
{
    use SoftDeletes;

    /**
     * 需要被转换成日期的属性。
     * 删除日期
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * 表名
     * @var string
     */
    protected $table = 'out_management';

    /**
     * 启用自动维护时间戳
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        'member_name',
        'bed_number',
        'out_time',
        'plan_to_return',
        'leave_days',
        'accompany_number',
        'accompany_name',
        'out_reason',
        'register_person',
        'check-in_time',
        'return_time',
        'actual_leave_days',
        'total',
        'expense_item',
    ];

}