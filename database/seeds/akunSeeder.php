<?php

use Illuminate\Database\Seeder;
use App\akun;

class akunSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(akun::class, 10)->create();
    }
}
