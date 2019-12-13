<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; //DB
use Illuminate\Support\Str; //string
use Carbon\Carbon; //tanggal
use App\agama;

class agamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('agama')->insert([[
        //     'agama' => Str::random(10),
        //     'add_by' => Str::random(20),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ], [
        //     'agama' => Str::random(10),
        //     'add_by' => Str::random(20),
        //     'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
        //     'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
        // ]]);
        factory(agama::class, 10)->create();
    }
}
