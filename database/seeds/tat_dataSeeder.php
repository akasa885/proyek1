<?php

use App\rehab_tat;
use Illuminate\Database\Seeder;

class tat_dataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(rehab_tat::class, 10)->create();
    }
}
