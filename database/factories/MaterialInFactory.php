<?php

/*
 * @author weifan
 * Friday 11th of December 2020 12:30:12 PM
 */

use Faker\Generator as Faker;

$factory->define(App\Model\MaterialIn::class, function (Faker $faker) {
    $date_time = $faker->date . ' ' . $faker->time;

    return [
        'inventory_id'   => $faker->randomDigit,
        'warehouse_name' => $faker->company,
        'in_number'      => $faker->word,
        'origin'         => $faker->company,
        'batch_number'   => $faker->word,
        'in_time'        => $faker->unixTime,
        'operator'       => $faker->name,
        'remarks'        => $faker->text,
        // 'in_material' => $faker->text,
        'amount'        => $faker->randomNumber(4, true),
        'created_at'    => $date_time,
        'updated_at'    => $date_time,
    ];
});
