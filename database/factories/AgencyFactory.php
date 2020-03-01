<?php

use Faker\Generator as Faker;
use App\Model\Agency;

$factory->define(Agency::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'serial_number'      => $faker->regexify('LS420200301[1-9]{8}'),
        'business_number'    => $faker->regexify('SK420200301[1-9]{8}'),
        'financial_type'     => $faker->numberBetween(0, 1),
        'money_flow'         => $faker->numberBetween(0, 1),
        'transaction_amount' => $faker->randomFloat(2, 10, 10000),
        'payment_channel'    => $faker->numberBetween(0, 4),
        'note'               => $faker->sentence(),
        'created_at'         => $date_time,
        'updated_at'         => $date_time,
    ];
});
