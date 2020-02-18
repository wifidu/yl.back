<?php

use Faker\Generator as Faker;
use App\Model\Account;

$factory->define(Account::class, function (Faker $faker) {
        $date_time = $faker->date . ' ' . $faker->time;
        $beds = $faker->randomDigit . '号楼-' . $faker->regexify('[1-9]{1}-[1-9]{3}-[1-9]{3}');
    return [
      'account_number' => $faker->regexify('A[1-9]{7}'),
      'member_number' => $faker->regexify('[1-9]{4}'),
      'member_name' => $faker->name,
      'beds' => $beds,
      'account_balance' => $faker->randomFloat(2, 100, 6666),
      'beds_cost' => $faker->randomFloat(2, 10, 1000),
      'meal_cost' => $faker->randomFloat(2, 10, 1000),
      'nursing_cost' => $faker->randomFloat(2, 10, 1000),
      'other_cost' => $faker->randomFloat(2, 100, 500),
      'created_at' => $date_time,
      'updated_at' => $date_time,
    ];
});
