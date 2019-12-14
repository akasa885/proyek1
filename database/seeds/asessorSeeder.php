<?php

use Illuminate\Database\Seeder;
use App\asessor;

class asessorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(asessor::class, 10)->create();
    }
}
