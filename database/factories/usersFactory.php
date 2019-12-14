<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\users;
use Faker\Generator as Faker;
use illuminate\Support\Str;

$factory->define(users::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => $faker->sha256, // password
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
