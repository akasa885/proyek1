<?php

use App\skhpn;
use Illuminate\Database\Seeder;

class skhpnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(skhpn::class, 10)->create();
    }
}
