<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Cycling;
use Faker\Generator as Faker;

$factory->define(Cycling::class, function (Faker $faker) {
    return [
      'place' => $faker->name(),
      'address' => $faker->phoneNumber(),
      'comment' => $faker->word()
    ];
});
