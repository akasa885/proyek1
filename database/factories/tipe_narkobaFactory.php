<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\tipe_narkoba;
use Faker\Generator as Faker;
use illuminate\Support\Str;

$factory->define(tipe_narkoba::class, function (Faker $faker) {
    return [
        'kode_narkoba' => Str::random(5),
        'jenis_narkoba' => Str::random(10),
        'add_by' => $faker->name,
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
