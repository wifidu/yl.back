<?php

use Faker\Generator as Faker;
use App\Model\Refund;

$factory->define(Refund::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    $unix_time = $faker->unixTime;
    return [
        'business_time' => $unix_time,  // 业务时间
        'refund_no'     => 'FK' . date("Ymd", $unix_time) . $faker->randomNumber(8, true),  // 退款单号
        'refund_type'   => $faker->numberBetween(0, 4),  // 退款类型
        'refund_amount' => $faker->randomFloat(2, 100, 6666),  // 退款金额
        'refund_status' => $faker->numberBetween(0, 1),  // 退款状态
        'refund_date'   => $faker->dateTimeThisMonth()->getTimestamp(),  // 退款日期
        'created_at'    => $date_time,
        'updated_at'    => $date_time,
        'spending_way'  => $faker->numberBetween(0,4),
        'agent'         => $faker->name,
        'note'          => $faker->sentence(6, true),
        'real_refund'   => $faker->randomFloat(2, 500, 1000),
        'deposit'       => $faker->randomFloat(2, 500, 1000),
        'refund_name'   => $faker->word,
    ];
});
