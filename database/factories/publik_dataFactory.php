<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\publik_data;
use Faker\Generator as Faker;
use Illuminate\support\Str;

$factory->define(publik_data::class, function (Faker $faker) {
    return [
        'kode_registrasi' => Str::random(10),
        'tgl_kedatangan' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'birth_date' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'nama_lengkap' => $faker->name,
        'gender' => Str::random(10),
        'umur' => Str::random(3),
        'nik_ktp' => Str::random(15),
        'agama' => Str::random(7),
        'suku' => Str::random(7),
        'narkoba' =>  Str::random(10),
        'status' =>  Str::random(10),
        'nama_ibu' => $faker->firstNameFemale,
        'nama_ayah' => $faker->firstNameMale,
        'alamat' => $faker->address,
        'no_hp' =>  Str::random(13),
        'no_hp_keluarga' => Str::random(13),
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
