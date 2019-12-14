<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            agamaSeeder::class,
            akunSeeder::class,
            asessorSeeder::class,
            jobsSeeder::class,
            publik_dataSeeder::class,
            skhpnSeeder::class,
            sukuSeeder::class,
            tat_dataSeeder::class,
            tipe_narkobaSeeder::class,
            usersSeeder::class
        ]);
    }
}
