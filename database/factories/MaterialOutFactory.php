<?php

/*
 * @author weifan
 * Friday 11th of December 2020 01:43:23 PM
 */

use Faker\Generator as Faker;

$factory->define(App\Model\MaterialOut::class, function (Faker $faker) {
    $date_time = $faker->dateTimeThisMonth;

    return [
        'inventory_id'   => $faker->randomDigit,
        'warehouse_name' => $faker->word,
        'out_number'     => $faker->word,
        'whereabouts'    => $faker->company,
        'user'           => $faker->name,
        'out_time'       => $faker->unixTime,
        'operator'       => $faker->name,
        'remarks'        => $faker->text,
        'amount'         => $faker->numberBetween(0, 100),
        'created_at'     => $date_time,
        'updated_at'     => $date_time,
    ];
});
