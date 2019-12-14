<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\skhpn;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(skhpn::class, function (Faker $faker) {
    return [
        'kode_registrasi' => Str::random(7),
        'nama_lengkap' => $faker->name,
        'tanggal_lahir' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'gender' => Str::random(10),
        'alamat' => $faker->address,
        'pekerjaan' => $faker->jobTitle,
        'email_address' => $faker->safeEmail,
        'keperluan' => $faker->sentence,
        'status' =>  Str::random(10),
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
