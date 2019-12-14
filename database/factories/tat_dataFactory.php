<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\rehab_tat;
use Faker\Generator as Faker;
use illuminate\Support\Str;

$factory->define(rehab_tat::class, function (Faker $faker) {
    return [
        'kode_registrasi' => Str::random(10),
        'instansi_pengaju' => Str::random(20),
        'nama_tersangka' => $faker->name,
        'nik_ktp' => Str::random(15),
        'alamat' => $faker->address,
        'tgl_penangkapan' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'tgl_sprin_tangkap' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'tgl_sprin_tahan' => $faker->dateTimeThismonth()->format('Y-m-d'),
        'barang_bukti' => Str::random(15),
        'berat' => Str::random(15),
        'nama_penyidik' => $faker->name,
        'no_hp_penyidik' => Str::random(13),
        'created_at' => $faker->dateTimeThismonth()->format('Y-m-d H:i:s'),
        'updated_at' => $faker->dateTimeThisMonth()->format('Y-m-d H:i:s')
    ];
});
