<?php

use Faker\Generator as Faker;

$factory->define(App\Model\BookBed::class, function (Faker $faker) {
    $date_time = $faker->dateTimeThisMonth;

    return [
        'bed_number' => $faker->word,       // 预约床位 (必填)
        'bed_cost' => $faker->randomFloat(2, 100, 100000),         // 床位费用 (必填)
        'check-in_date' => $faker->randomNumber,    // 入住日期 (必填)
        'appoint_deposit' => $faker->randomFloat(2, 0, 1000),  // 预付押金
        'contract_number' => $faker->phoneNumber,  // 联系电话 (必填)
        'appoint_person' => $faker->name,   // 预约人 (必填)
        'appoint_time' => $faker->randomNumber,     // 预约时间
        'elderly_name' => $faker->name,     // 老人姓名 (必填)
        // 'elderly_ID' => $faker->phoneNumber,       // 老人身份证号
        'elderly_age' => $faker->numberBetween(50, 120),      // 老人年龄
        'elderly_gender' => $faker->numberBetween(0, 1),   // 老人姓名 0-男 1-女 (必填)
        'self-care_ability' => $faker->numberBetween(0, 2),// 老人自理能力 (必填)
        'address' => $faker->address,          // 居住地址
        'remark' => $faker->word,           // 备注 ( 必填 )
        'created_at'     => $date_time,
        'updated_at'     => $date_time,
    ];
});
