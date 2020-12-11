<?php

/*
 * @author weifan
 * Friday 11th of December 2020 11:35:58 AM
 */

use Faker\Generator as Faker;

$factory->define(App\Model\Material::class, function (Faker $faker) {
        $date_time = $faker->date . ' ' . $faker->time;
    return [
        'name'       => $faker->word,
        'brand'      => $faker->word,
        'model'      => $faker->word,
        'unit'       => $faker->numberBetween(0, 2),
        'supplier'   => $faker->word,
        'price'      => $faker->randomFloat(2, 10, 5000),
        'number'     => $faker->randomNumber(5, true),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});
