<?php

use Illuminate\Database\Seeder;
use App\tat_data;

class tat_dataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(tat_data::class, 10)->create();
    }
}
