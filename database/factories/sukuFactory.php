<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\suku;
use Faker\Generator as Faker;
use illuminate\Support\Str;

$factory->define(suku::class, function (Faker $faker) {
    return [
        'nama_suku' => Str::random(10),
        'add_by' => $faker->name,
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
