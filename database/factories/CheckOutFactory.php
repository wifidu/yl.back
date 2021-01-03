<?php

use Faker\Generator as Faker;

$factory->define(App\Model\CheckOut::class, function (Faker $faker) {
    return [
        'check-out_time' => $faker->unixTime,
        'check-out_reason' => $faker->word,
        'manager' => $faker->name,
        'manage_time' => $faker->unixTime,
        'remark' => $faker->word,
        'account_balance' => $faker->randomFloat(2, 0, 1000),
        'expense_item' => $faker->word
    ];
});
