<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\klinikrehab;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(klinikrehab::class, function (Faker $faker) {
    return [
        'no_id' => Str::random(10),
        'kode_registrasi' => Str::random(10),
        'medicalDate' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'medicalTime' => $faker->dateTimeThismonth()->format('H:i'),
        'medicalLocation' => Str::random(20),
        'kesadaran' => Str::random(20),
        'keadaan_umum' => Str::random(20),
        'tekananDarah' => Str::random(7),
        'nadi' => $faker->numberbetween(0, 300),
        'breath' =>  $faker->numberbetween(0, 300),
        'medicineUse' =>  $faker->numberbetween(0, 1),
        'medicineType' => Str::random(20),
        'medicineFrom' => Str::random(20),
        'lastDrink' => Str::random(20),
        'rAmphetamine' =>  $faker->numberbetween(0, 1),
        'rMethaphetamine' => $faker->numberbetween(0, 1),
        'rTHC' => $faker->numberbetween(0, 1),
        'rMorphin' =>  $faker->numberbetween(0, 1),
        'rBenzodiazepine' =>  $faker->numberbetween(0, 1),
        'rCocaine' =>  $faker->numberbetween(0, 1),
        'add_by' => $faker->name,
        'medicalResult' =>  $faker->numberbetween(0, 1),
        'status' => Str::random(20),
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
