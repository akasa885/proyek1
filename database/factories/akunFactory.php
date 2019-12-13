<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\akun;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(akun::class, function (Faker $faker) {
    return [
        'username' => Str::random(10),
        'password' => $faker->sha256, // password
        'pas_back' => Str::random(20),
        'integritas' => Str::random(20),
        'status' => Str::random(20),
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
