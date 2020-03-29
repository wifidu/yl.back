<?php

/*
 * @author weifan
 * Sunday 29th of March 2020 12:54:47 PM
 */

use App\Model\Visit;
use Faker\Generator as Faker;

$factory->define(Visit::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    $unix_time = $faker->unixTime;

    return [
        'visitor'      => $faker->name,
        'phone'        => $faker->phoneNumber,
        'visit_time'   => $unix_time,
        /* 'member_name'  => $faker->name, */
        'visit_reason' => $faker->text,
        'created_at'   => $date_time,
        'updated_at'   => $date_time,
    ];
});
