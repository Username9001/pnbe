<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guild;

class GuildsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Bonsai Guild
        Guild::create([
            'id' => 1,
            'name' => 'Bonsai Guild',
            'description' => 'Bonsai trees in pots',
            'location' => 'garden',
            'soil_structure' => 'Potting soil',
            'soil_ph' => 'Neutral',
            'shade' => 'Half Shade'
        ]);
        
        // Herb Guild
        Guild::create([
            'id' => 2,
            'name' => 'Herb Guild',
            'description' => 'Herbs, mostly herbacious, some perennial',
            'location' => 'garden',
            'soil_structure' => 'Potting soil',
            'soil_ph' => 'Neutral',
            'shade' => 'Half Shade'
        ]);
    }
}
