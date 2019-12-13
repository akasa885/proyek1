<?php

use App\publik_data;
use Illuminate\Database\Seeder;

class publik_dataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(publik_data::class, 10)->create();
    }
}
