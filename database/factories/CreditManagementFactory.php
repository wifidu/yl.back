<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 10:49:43 AM
 */

use App\Model\CreditManagement;
use Faker\Generator as Faker;

$factory->define(CreditManagement::class, function (Faker $faker) {
    $unix_time = $faker->unixTime;
    $date_time = $faker->dateTimeThisMonth;

    return [
        'created_at'        => $date_time,
        'updated_at'        => $date_time,
        'business_time'     => $unix_time,
        'billing_date'      => $unix_time,
        'payment_type'      => $faker->numberBetween(0, 1),
        'amount_receivable' => $faker->randomFloat(2, 100, 90000),
        'account_balance'   => $faker->randomFloat(2, 0, 5000),
        'voucher_no'        => 'SK4' . date('Ymd', $unix_time) . $faker->randomNumber(8, true),
        'if_pay'            => $faker->numberBetween(0, 1),
    ];
});
