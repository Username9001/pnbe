<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specy;
use App\Models\GGBSpecy;

class GGBTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $species_list = Specy::skip(6000)->take(1000)->get();
        foreach($species_list as $specy)
        {
            GGBSpecy::create([
                'id' => $specy['id'] ?? null,
                // naming of the plant
                'latin_name' => $specy['latin_name']  ?? null,
                'slug' => $specy['slug']  ?? null,
                'author' => $specy['author']  ?? null,
                'common_english' => $specy['common_english']  ?? null,
                // image
                'wiki_img' => $specy['wiki_img']  ?? null,
                // useful information about habit/soil
                'habit' => $specy['habit']  ?? null,
                'deciduous_evergreen' => $specy['deciduous_evergreen']  ?? null,
                'soil_pref' => $specy['soil_pref'] ?? null,
                'moisture_pref' => $specy['moisture_pref'] ?? null,
                'ph_pref' => $specy['ph_pref'] ?? null,
                'shade_pref' => $specy['shade_pref'] ?? null,
                // size of the plant
                'height' => $specy['height']  ?? null,
                'width' => $specy['width']  ?? null,
                // climate information
                'frost_tender' => $specy['frost_tender']  ?? null,
                'hardyness' => $specy['hardyness'] ?? null,
                'cultivars' => $specy['cultivars'] ?? null,
                'completion_status' => $this->checkParamsCompletion($specy),
            ]);
        };
    }

    // See what params are filled out, and which ones need to be completed with user input
    public function checkParamsCompletion($input)
    {
        $params_list = [
            'latin_name',
            'author',
            'common_english',
            'habit',
            'deciduous_evergreen',
            'soil_pref',
            'moisture_pref',
            'ph_pref',
            'shade_pref',
            'height',
            'width',
            'frost_tender',
            'hardyness',
        ];
        foreach($params_list as $param)
        {
            if($input[$param] == null)
            {
                return false;
            }
        };
        return true;
    }

}
