<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\jobs;
use Faker\Generator as Faker;

$factory->define(jobs::class, function (Faker $faker) {
    return [
        'nama_pekerjaan' => $faker->jobTitle,
        'add_by' => $faker->name,
        'created_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
