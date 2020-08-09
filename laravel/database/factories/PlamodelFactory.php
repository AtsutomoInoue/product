<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Plamodel;
use Faker\Generator as Faker;

$factory->define(Plamodel::class, function (Faker $faker) {
    return [
        'name' => $faker->name(),
        'maker' => $faker->name(),
        'price' => $faker->numberBetween($min = 300, $max= 20000),
        'released' => $faker->numberBetween($min = 197001, $max=202008),
        'point' => $faker->word(),
        'comment' => $faker->word(),
    ];
});
