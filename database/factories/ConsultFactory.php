<?php

/*
 * @author weifan
 * Monday 6th of April 2020 10:22:51 AM
 */

use App\Model\Consult;
use Faker\Generator as Faker;

$factory->define(Consult::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    $intentions = ['了解情况', '有意入住'];

    return [
        'created_at'       => $date_time,
        'updated_at'       => $date_time,
        'time'             => $faker->unixTime,
        'consultant'       => $faker->name,
        'phone'            => $faker->phoneNumber,
        'consult_type'     => $faker->numberBetween(0, 2),
        'intention'        => $faker->randomElement($intentions),
        'member_name'      => $faker->name,
        'age'              => $faker->numberBetween(23, 50),
        'selfcare_ability' => $faker->numberBetween(0, 2),
        'note'             => $faker->text,
        'result'           => $faker->randomElement(['已入住', '准备入住', '不打算入住']),
    ];
});
