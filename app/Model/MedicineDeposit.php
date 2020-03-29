<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicineDeposit extends Model
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
    protected $table = 'drug_deposit_infor';

    /**
     * 启用自动维护时间戳
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        'member_name',
        'bed_number',
        'drug_name',
        'unit',
        'surplus_medicine',
        'warning_number',
    ];

}