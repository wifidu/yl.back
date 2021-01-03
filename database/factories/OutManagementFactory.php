<?php

use Faker\Generator as Faker;

$factory->define(App\Model\OutManage::class, function (Faker $faker) {
    return [
        'out_time' => $faker->unixTime,
        'plan_to_return' => $faker->unixTime,
        'leave_days' => $faker->numberBetween(1, 100),
        'accompany_number' => $faker->phoneNumber,
        'accompany_name' => $faker->name,
        'out_reason' => $faker->text,
        'register_person' => $faker->name,
        'check-in_time' => $faker->unixTime,
        'return_time' => $faker->unixTime,
        'actual_leave_days' => $faker->numberBetween(1, 100),
        'total' => $faker->randomFloat(2, 1, 100000),
        'expense_item' => $faker->text,
    ];
});
