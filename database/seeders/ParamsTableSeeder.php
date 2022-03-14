<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Specy;
use App\Models\Param;

class ParamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // REGIONS
        $regions_all = array();
        $britain_array = array();
        $europe_array = array();
        $mediterranean_array = array();
        $w_asia_array = array();
        $e_asia_array = array();
        $n_america_array = array();
        $s_america_array = array();
        $africa_array = array();
        $australasia_array = array();
        $other_array = array();
        // Species
        $species_list = Specy::all();
        foreach($species_list as $specy)
        {
            // explode queried array
            $regions_array = $specy['regions'];
            // combine regions with their params
            foreach($regions_array as $k => $v)
            {
                if($k == 'britain')
                {
                    if(!in_array($v, $britain_array))
                    {
                        array_push($britain_array, $v);
                    };
                };
                if($k == 'europe')
                {
                    if(!in_array($v, $europe_array))
                    {
                        array_push($europe_array, $v);
                    };
                };
                if($k == 'mediterranean')
                {
                    if(!in_array($v, $mediterranean_array))
                    {
                        array_push($mediterranean_array, $v);
                    };
                };
                if($k == 'w_asia')
                {
                    if(!in_array($v, $w_asia_array))
                    {
                        array_push($w_asia_array, $v);
                    };
                };
                if($k == 'e_asia')
                {
                    if(!in_array($v, $e_asia_array))
                    {
                        array_push($e_asia_array, $v);
                    };
                };
                if($k == 'n_america')
                {
                    if(!in_array($v, $n_america_array))
                    {
                        array_push($n_america_array, $v);
                    };
                };
                if($k == 's_america')
                {
                    if(!in_array($v, $s_america_array))
                    {
                        array_push($s_america_array, $v);
                    };
                };
                if($k == 'africa')
                {
                    if(!in_array($v, $africa_array))
                    {
                        array_push($africa_array, $v);
                    };
                };
                if($k == 'australasia')
                {
                    if(!in_array($v, $australasia_array))
                    {
                        array_push($australasia_array, $v);
                    };
                };
                if($k == 'other')
                {
                    if(!in_array($v, $other_array))
                    {
                        array_push($other_array, $v);
                    };
                };
            };

        }
        // sort alphabetically
        sort($britain_array);
        sort($europe_array);
        sort($mediterranean_array);
        sort($w_asia_array);
        sort($e_asia_array);
        sort($n_america_array);
        sort($s_america_array);
        sort($africa_array);
        sort($australasia_array);
        sort($other_array);
        // create list of all the params in pf
        Param::create([
            'britain_array' => $britain_array,
            'europe_array' => $europe_array,
            'mediterranean_array' => $mediterranean_array,
            'w_asia_array' => $w_asia_array,
            'e_asia_array' => $e_asia_array,
            'n_america_array' => $n_america_array,
            's_america_array' => $s_america_array,
            'africa_array' => $africa_array,
            'australasia_array' => $australasia_array,
            'other_array' => $other_array,
        ]);

        // NICHES
        $params_all = array();
        $species_list = Specy::all();
        foreach($species_list as $specy)
        {
            // explode queried array
            $params_array = $specy['other_uses'];
            // add words that are not in params list
            foreach($params_array as $param)
            {
                if(!in_array($param, $params_all))
                {
                    array_push($params_all, $param);
                };
            };
        }
        // sort alphabetically
        sort($params_all);
        // create list of all the params in pf
        Param::create([
            'params' => $params_all
        ]);
        return;
    }
}
