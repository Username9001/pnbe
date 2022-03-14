<?php

namespace Database\Seeders;

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
        // $this->call(GuildsTableSeeder::class);
        // $this->call(PlantsTableSeeder::class);
        // $this->call(SpeciesTableSeeder::class);
        // $this->call(ParamsTableSeeder::class);
        $this->call(GGBTableSeeder::class);
    }
}
