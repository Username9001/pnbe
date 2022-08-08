<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plant;
use App\Models\Specy;

class PlantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     
        // First guild: bonsai
        Plant::create([
            'id' => 1,
            'name' => 'Pinus Mugo (1)',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 5285385,
            'guild_id' => 1
        ]);  

        Plant::create([
            'id' => 2,
            'name' => 'Pinus Mugo (2)',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 5285385,
            'guild_id' => 1
        ]);  

        Plant::create([
            'id' => 3,
            'name' => 'Alder',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2876528,
            'guild_id' => 1
        ]);  

        Plant::create([
            'id' => 4,
            'name' => 'Juniper',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2684690,
            'guild_id' => 1
        ]);  

        Plant::create([
            'id' => 5,
            'name' => 'Bonsai Juniper (2)',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2684363,
            'guild_id' => 1
        ]);  

        Plant::create([
            'id' => 11,
            'name' => 'Min Fir',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2685593,
            'guild_id' => 1
        ]);  

        // Second guild: herbs
        Plant::create([
            'id' => 6,
            'name' => 'Thyme',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 5341442,
            'guild_id' => 2
        ]);  

        Plant::create([
            'id' => 7,
            'name' => 'Mint',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2927175,
            'guild_id' => 2
        ]);  

        Plant::create([
            'id' => 8,
            'name' => 'Peppermint',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 8707933,
            'guild_id' => 2
        ]);  

        Plant::create([
            'id' => 9,
            'name' => 'Basil',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2927096,
            'guild_id' => 2
        ]);  

        Plant::create([
            'id' => 10,
            'name' => 'Chives',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maiores illum, culpa minus? Id veritatis possimus natus facilis est nisi non vero, cum sint recusandae praesentium exercitationem dolorum itaque vitae eos consequuntur magni accusantium officia at.',
            'planting_date' => '12/23/2018 04:20',
            'location' => 'garden',
            'soil' => 'potting soil',
            'specy_id' => 2855860,
            'guild_id' => 2
        ]);  

    }
}
