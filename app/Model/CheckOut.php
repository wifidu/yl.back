<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CheckOut extends Model
{
    use SoftDeletes;

    protected $table = 'check-out_information';

    /**
     * 需要被转换成日期的属性。
     * 删除日期
     * @var array
     */
    protected $dates = ['deleted_at'];

    public $timestamps = true;


    public $fillable = [
        'member_name',
        'member_ID',
        'bed',
        'check-out_time',
        'check-out_reason',
        'manager',
        'manage_time',
        'remark',
        'account_balance',
        'expense_item'
    ];


}