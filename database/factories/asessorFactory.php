<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\asessor;
use Faker\Generator as Faker;
use illuminate\Support\Str;

$factory->define(asessor::class, function (Faker $faker) {
    return [
        'kode_as' => Str::random(5),
        'nama' => $faker->name,
        'birth_date' => $faker->dateTimeThisDecade()->format('Y-m-d'),
        'deskripsi' => $faker->text,
        'photo_loc' => Str::random(20),
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
