<?php

use App\rehab_publik;
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
        factory(rehab_publik::class, 10)->create();
    }
}
