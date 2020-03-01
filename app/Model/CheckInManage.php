<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckInManage extends Model
{

    use SoftDeletes;
    protected $table = "registration_form";

    /**
     * 需要被转换成日期的属性。
     * 删除日期
     * @var array
     */
    protected $dates = ['deleted_at'];

    public $timestamps = true;

    protected $fillable = [
        "member_name",
        "care_level",
        "check-in_time",
        "bed_cost",
        "meal_cost",
        "one-time_cost",
        "business_change_reason",
        "business_change_date",
        "meal_change_date",
        "meal_change_reason"
    ];

}