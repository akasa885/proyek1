<?php

use App\klinikrehab;
use Illuminate\Database\Seeder;

class klinikrehabSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(klinikrehab::class, 10)->create();
    }
}
