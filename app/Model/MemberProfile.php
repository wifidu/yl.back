<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MemberProfileController
 * 会员档案表模型类
 * @package App
 * @author YanJiGang
 */
class MemberProfile extends Model
{
    /**
     * 表名
     * @var string
     */
    protected $table = 'member_profile';

    /**
     * 启用自动维护时间戳
     * @var bool
     */
    public $timestamps = true;

    protected $fillable = [
        'member_name',          //会员名( 必填 )
        'member_ID',            //会员身份证号
        'gender',               //性别( 必填 )
        'nation',               //民族
        'height',               //身高( 必填 )
        'weight',               //体重( 必填 )
        'birth_date',           //出生日期( 必填 )
        'own_system',           //所属系统( 必填 )
        'sign_doctor',          //签约医生
        'community',            //社区
        'email',                //邮箱
        'phone_number',         //手机号( 必填 )
        'address',              //地址
        'domicile',             //户籍所在地
        'avatar_url'            //头像 url
    ];
    
}
