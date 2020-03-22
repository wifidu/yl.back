<?php


namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeathRegistration extends Model
{
    use SoftDeletes;

    protected $table = 'death_registration';

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
        'family_address',
        'contact_number',
        'check-in_main_diagnosis',
        'death_time',
        'certificate_time',
        'death_disease',
        'certificate_doctor'
    ];

}