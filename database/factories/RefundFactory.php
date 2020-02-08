<?php

use Faker\Generator as Faker;
use App\Model\Refund;

$factory->define(Refund::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    $unix_time = $faker->unixTime;
    $beds = $faker->randomDigit . '号楼-' . $faker->regexify('[1-9]{1}-[1-9]{3}-[1-9]{3}');
    return [
        'business_time' => $unix_time,  // 业务时间
        'refund_no' => 'FK' . date("Ymd", $unix_time) . $faker->randomNumber(8, true),  // 退款单号
        'member_name' => $faker->name,  // 会员姓名
        'beds' => $beds,  // 床位
        'refund_type' => $faker->numberBetween(0, 3),  // 退款类型
        'refund_amount' => $faker->randomFloat(2, 100,6666),  // 退款金额
        'refund_status' => $faker->numberBetween(0, 1),  // 退款状态
        'refund_date' => $faker->dateTimeThisMonth()->getTimestamp(),  // 退款日期
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
