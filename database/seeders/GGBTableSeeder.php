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
        $species_list = Specy::skip(7000)->take(1000)->get();
        foreach($species_list as $specy)
        {
            GGBSpecy::create([
                'id' => $specy['id'] ?? null,
                'scientific_name' => $specy['latin_name']  ?? null,
                'author' => $specy['author']  ?? null,
                'common_english' => $specy['common_english']  ?? null,
                'habit' => $specy['habit']  ?? null,
                'deciduous_evergreen' => $specy['deciduous_evergreen']  ?? null,
                'height' => $specy['height']  ?? null,
                'width' => $specy['width']  ?? null,
                'frost_tender' => $specy['frost_tender']  ?? null,
                'hardiness' => $specy['hardyness'] ?? null,
                'cultivars' => $specy['cultivars'] ?? null,
                'shade_pref' => $specy['shade_pref'] ?? null,
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
            'height',
            'width',
            'frost_tender',
            'hardyness',
            'shade_pref',

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
