<?php

use Faker\Generator as Faker;

$factory->define(App\Model\MemberProfile::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'member_name' => $faker->name,          //会员名( 必填 )
        'member_ID' => $faker->word,            //会员身份证号
        'gender' => $faker->regexify('[0-1]{1}'),               //性别( 必填 )
        'nation' => '汉族',               //民族
        'height' => $faker->numberBetween(140, 220),               //身高( 必填 )
        'weight' => $faker->numberBetween(80, 200),               //体重( 必填 )
        'birth_date' => $faker->date,           //出生日期( 必填 )
        'own_system' => $faker->word,           //所属系统( 必填 )
        'sign_doctor' => $faker->name,          //签约医生
        'community' => $faker->address,            //社区
        'email' => $faker->Email,                //邮箱
        'phone_number' => $faker->phoneNumber,         //手机号( 必填 )
        'address' => $faker->address,              //地址
        'domicile' => $faker->city,             //户籍所在地
        'avatar_url' => $faker->word,           //头像 url
        'created_at' => $date_time,
        'updated_at' => $date_time
    ];
});
