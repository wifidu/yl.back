<?php

use App\Model\Accident;
use Faker\Generator as Faker;

$factory->define(Accident::class, function (Faker $faker) {
        $date_time = $faker->date . ' ' . $faker->time;
    return [
        'created_at'     => $date_time,
        'updated_at'      => $date_time,
        'level_accident'  => $faker->numberBetween(0, 2),
        'occurrence_time' => $faker->unixTime,
        'duty_personnel'  => $faker->name,
        'head'            => $faker->name,
        'type'            => $faker->word,
        'description'     => $faker->sentence
    ];
});
