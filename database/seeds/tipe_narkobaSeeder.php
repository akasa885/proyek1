<?php

use App\tipe_narkoba;
use Illuminate\Database\Seeder;

class tipe_narkobaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(tipe_narkoba::class, 10)->create();
    }
}
