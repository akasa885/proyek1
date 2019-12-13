<?php

use App\suku;
use Illuminate\Database\Seeder;

class sukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(suku::class, 10)->create();
    }
}
