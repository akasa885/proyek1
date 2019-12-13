<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\agama;
use Faker\Generator as Faker;

$factory->define(agama::class, function (Faker $faker) {
    return [
        'agama' => $faker->name,
        'add_by' => $faker->name,
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
