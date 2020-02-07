<?php

use App\Model\CreditManagement;
use Faker\Generator as Faker;

$factory->define(CreditManagement::class, function (Faker $faker) {
    $unix_time = $faker->unixTime;
    $beds = $faker->randomDigit . '号楼-' . $faker->regexify('[1-9]{1}-[1-9]{3}-[1-9]{3}');
    return [
        'business_time' => $unix_time,
        'billing_date' => $unix_time,
        'member_name' => $faker->name,
        'beds' => $beds,
        'payment_type' => $faker->numberBetween(0, 1),
        'amount_receivable' => $faker->randomFloat(2, 100, 90000),
        'account_balance' => $faker->randomFloat(2, 0, 5000),
        'voucher_no' => 'SK4' . date("Ymd", $unix_time) . $faker->randomNumber(8, true),
        'if_pay' => $faker->numberBetween(0, 1)
    ];
});
