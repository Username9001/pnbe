<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\OldSpecy;
use App\Models\Location;
use App\Models\Book;
use App\Models\Range;
use App\Models\Scented;
use App\Models\Cultivar;
use App\Models\Medicinal;
use App\Models\Edible;
use App\Models\Other;
use App\Models\Specy;

class SpeciesTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    // TODO
    // Use GBIF to identify native locations of plants and add an enumeration of this:
    // 'natural_habitats': $this->getGbifLocations
    // TODO
    // Figure out how to handle subspecies and varieties
    public function run()
    {
        // TODO
        // Optimize the seeder so it does not time out
        $species_list = OldSpecy::skip(6500)->take(1000)->get();
        // $species_list = OldSpecy::all();
        foreach($species_list as $specy) 
        {
            // check the relational tables from the db
            // garden location
            $location = Location::where('Latin name', $specy['latin_name'])->first() ?? null;
            // geographic location
            $range = Range::where('Latin name', $specy['latin_name'])->first() ?? null;
            $scented = Scented::where('LatinName', $specy['latin_name'])->first() ?? null;
            $gbif_id = $this->getGbif($specy['latin_name']);
            // Check whether specy is already in db
            $present_specy = Specy::where('gbif_id', $gbif_id)->first() ?? null;
            if(!$present_specy)
            {
                Specy::create([
                    // meta descriptors
                    // Use a seperate id (without _) to make lighthouse life easier
                    'id' => $gbif_id,
                    'latin_name' => $this->getGbifCanonicalName($specy['latin_name']),
                    'slug' => strtolower($this->getGbifCanonicalName($specy['latin_name'])),
                    'author' => $specy['Author'],
                    'common_english' => $this->getGbifCommonEnglish($specy['latin_name']),
                    'family' => $specy['family'],
                    'record_checked' => $specy['Record checked'],
                    // GBIF Identification
                    'gbif_id' => $this->getGbif($specy['latin_name']),
                    // Wikipedia image
                    'wiki_img' => $this->getWiki($specy['latin_name']) ?? 'https://plantmonitor.ams3.digitaloceanspaces.com/uploads/background.jpg',
                    // Taxonomy
                    'taxons' => [
                        'taxon_kingdom' => $this->getGbifTaxons($specy['latin_name'])['kingdom'] ?? null,
                        'taxon_phylum' => $this->getGbifTaxons($specy['latin_name'])['phylum'] ?? null,
                        'taxon_class' => $this->getGbifTaxons($specy['latin_name'])['class'] ?? null,
                        'taxon_order' => $this->getGbifTaxons($specy['latin_name'])['order'] ?? null,
                        'taxon_family' => $this->getGbifTaxons($specy['latin_name'])['family'] ?? null,
                        'taxon_genus' => $this->getGbifTaxons($specy['latin_name'])['genus'] ?? null,
                    ],
                    // Range
                    // one array for each 'continental' region
                    'regions_britain' => $this->enumerateRegions($range['Britain'] ?? null),
                    'regions_europe' => $this->enumerateRegions($range['Europe'] ?? null),
                    'regions_mediterranean' => $this->enumerateRegions($range['Mediterranean'] ?? null),
                    'regions_w_asia' => $this->enumerateRegions($range['W Asia'] ?? null),
                    'regions_e_asia' => $this->enumerateRegions($range['E Asia'] ?? null),
                    'regions_n_america' => $this->enumerateRegions($range['N America'] ?? null),
                    'regions_s_america' => $this->enumerateRegions($range['S America'] ?? null),
                    'regions_africa' => $this->enumerateRegions($range['Africa'] ?? null),
                    'regions_australasia' => $this->enumerateRegions($range['Australasia'] ?? null),
                    'regions_other' => $this->enumerateRegions($range['Other'] ?? null),
                    // long text descriptors
                    'descriptions' => [
                        'medicinal' => $specy['Medicinal'],
                        'region' => $specy['Range'],
                        'habitat' => $specy['Habitat'],
                        'hazards' => $specy['hazards'],
                        'synonyms' => $specy['Synonyms'],
                        'cultivation_details' => $specy['cultivation_details'],
                        'propagation' => $specy['Propagation 1'],
                        'edible_uses' => $specy['Edible uses'],
                        'uses_notes' => $specy['Uses notes'],
                        'site_specific_notes' => $specy['SiteSpecificNotes'],
                    ],
                    // species features
                    'habit' => $specy['habit'],
                    // TODO Change the abbreviations to something more useful
                    'deciduous_evergreen' => $specy['Deciduous/Evergreen'],
                    // 'soil_pref' => $specy['soil_pref'],
                    // 'shade_pref' => $specy['shade_pref'],
                    'wind' => $specy['Wind'],
                    'height' => $specy['Height'],
                    'width' => $specy['Width'],
                    'hardyness' => $specy['hardyness'],
                    'growth_rate' => $specy['growth_rate'],
                    'flower_type' => $specy['Flower Type'],
                    // TODO Redefine self_fertile, frost_tender and pollution to be booleans
                    'self_fertile' => $specy['Self-fertile'],
                    // Only about 25% has a FrostTender value
                    'frost_tender' => $specy['FrostTender'],
                    'pollution' => $specy['Pollution'],
                    'acid' => boolval($specy['Acid']),
                    'alkaline' => boolval($specy['Alkaline']),
                    'saline' => boolval($specy['Saline']),
                    'well_drained' => boolval($specy['well_drained']),
                    'in_cultivation' => boolval($specy['In cultivation?']),
                    'nitrogen_fixer' => boolval($specy['Nitrogen fixer']),
                    'poor_soil' => boolval($specy['Poor soil']),
                    'drought' => boolval($specy['Drought']),
                    'wildlife' => boolval($specy['Wildlife']),
                    'has_cultivars' => boolval($specy['Cultivars']),
                    'cultivars_in_cultivation' => boolval($specy['Cultivars in cultivation']),
                    'heavy_clay' => boolval($specy['Heavy clay']),
                    'pull_out' => boolval($specy['Pull-out']),
                    'scented' => boolval($specy['Scented']),
                    // scented meta
                    'scented_meta' => [
                        'plant_part' => $scented['PlantPart'] ?? null,
                        'fresh' => $scented['Fresh'] ?? null,
                        'crushed' => $scented['Crushed'] ?? null,
                        'dried' => $scented['Dried'] ?? null,
                        'notes' => $scented['Notes'] ?? null,
                        // 'latin_name' => $scented['LatinName'] ?? null,
                    ],
                    'soil_pref'=> $this->enumerateSoilPreferences($specy['soil_pref']) ?? null,
                    'shade_pref'=> $this->enumerateShadePreferences($specy['shade_pref']) ?? null,
                    'shade_locations' => $this->enumerateShadeLocations($location) ?? null,
                    'moisture_pref' => $this->enumerateMoisturePreferences($specy['moisture_pref']) ?? null,
                    'ph_pref' => $this->enumeratePhPreferences($specy['pH']) ?? null,
                    // species garden locations
                    'garden_locations' => $this->enumerateLocations($location),
                    // permaculture/food forest layers
                    'garden_layers' => $this->enumerateLayers($location, $specy['habit']),
                    // from "plantlocations"
                    'garden_walls' => [
                        'north_wall' => $location['NorthWall'] ?? 'NA',
                        'east_wall' => $location['EastWall'] ?? 'NA',
                        'south_wall' => $location['SouthWall'] ?? 'NA',
                        'west_wall' => $location['WestWall'] ?? 'NA',
                    ],
                    // Pollinators
                    'pollinators' => $this->enumeratePollinators($specy['pollinators']),
                    // Uses
                    // Medicinal uses
                    'medicinal_uses' => $this->enumerateMedicinalUses($specy['latin_name']),
                    // Edible uses
                    'edible_uses' => $this->enumerateEdibleUses($specy['latin_name']),
                    // Other uses
                    'other_uses' => $this->enumerateOtherUses($specy['latin_name']),
                    // permaflorae ratings
                    'ratings' => [
                        'overall_rating' => $specy['Rating'],
                        'use_rating' => $specy['Use_rating'],
                        'grow_rating' => $specy['Grow_rating'],
                        'palatable_rating' => $specy['palatable_rating'],
                        'medicinal_rating' => $specy['Medicinal Rating'],
                    ],
                    // dates
                    'dates' => [
                        'in_leaf' => $specy['In leaf'],
                        'flowering_month' => $specy['flowering_month'],
                        'seed_ripens' => $specy['Seed ripens'],
                        'in_leaf_start' => $specy['In leaf start'],
                        'in_leaf_end' => $specy['In leaf end'],
                        'flowering_time_start' => $specy['Flowering time start'],
                        'flowering_time_end' => $specy['Flowering time end'],
                        'seed_ripens_start' => $specy['Seed ripens start'],
                        'seed_ripens_end' => $specy['Seed ripens end'],
                    ],
                    // booklist
                    // 'botanical_references' => $this->getBotanicalReferences($specy) ?? null,
                    'book_list' => $this->getBookList($specy),
                    // common names in different languages from GBIF
                    'common_names' => $this->getGbifCommonNames($specy['latin_name']),
                    // parent species for varieties and subspecies from GBIF
                    'parent' => $this->getGbifParent($specy['latin_name']) ?? null,
                    // cultivars
                    'cultivars' => $this->getCultivars($specy['latin_name']),
                    // locations from GBIF
                    'gbif_locations' => $this->getGbifLocations($specy['latin_name']),
                    // old ID
                    'pf_id' => $specy['id'],
                ]);
                // $present_specy = null;
            };
        }
    }

    // Gets the GBIF identification key and params
    // Currently using species as lowest taxon
    public function getGbif($input)
    {
        // Set the endpoint & parameters
        $endPoint = "https://api.gbif.org/v1/species/match";
        $params = [
            "kingdom" => "Plantae",
            "name" => $input
        ];
        // Combine endpoint & parameters
        $url = $endPoint . "?" . http_build_query( $params );
        // Init curl
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $result = json_decode( $output, true );
        // Check synonyms
        if($result && $result['status'] === 'SYNONYM')
        {
            return $result['acceptedUsageKey'];
        }
        return $result['usageKey'];
    }

    // TODO 
    // Combine these GBIF requests to a single function(?)
    // GBIF Scientific name as source of truth for synonyms
    public function getGbifCanonicalName($input)
    {
        $gbif_id = $this->getGbif($input);
        // GBIF species page
        $endPoint = "https://api.gbif.org/v1/species/";
        $url = $endPoint . $gbif_id;
        // CURL
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $species_name_result = json_decode( $output, true );
        return $species_name_result['canonicalName'];
    }

    // GBIF Common name 
    public function getGbifCommonNames($input)
    {
        $gbif_id = $this->getGbif($input);
        // GBIF species page
        $endPoint = "https://api.gbif.org/v1/species/";
        $url = $endPoint . $gbif_id . "/vernacularNames";
        // CURL
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $species_common_names = json_decode( $output, true );
        return $species_common_names['results'];
    }

    // GBIF Common English name
    public function getGbifCommonEnglish($input)
    {
        $gbif_names_list = $this->getGbifCommonNames($input);
        $name_array = array();
        // filter out English
        foreach($gbif_names_list as $name_block)
        {
            if ($name_block['language'] == 'eng')
            {
                // do some trimming
                $v_name = $name_block['vernacularName'];
                $v_name = str_replace('-', ' ', $v_name);
                $v_name = stripcslashes($v_name);
                $v_name = ucwords($v_name);
                if(!in_array($v_name, $name_array))
                {
                    array_push($name_array, $v_name);
                }
            }
        }
        return $name_array;
    }

    // GBIF Parent if variety or subspecies
    public function getGbifParent($input)
    {
        $gbif_id = $this->getGbif($input);
        // GBIF species page
        $endPoint = "https://api.gbif.org/v1/species/";
        $url = $endPoint . $gbif_id;
        // CURL
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $specy = json_decode( $output, true );
        if ($specy['rank'] == 'VARIETY')
        {
            return $specy['parentKey'];
        }
        return;
    }

    // Locations from GBIF
    public function getGbifLocations($input)
    {
        $gbif_id = $this->getGbif($input);
        // Set endpoint & params
        $endPoint = "https://api.gbif.org/v1/species/";
        // Combine endpoint & params
        $url = $endPoint . $gbif_id . "/distributions?limit=200";

        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $location_result = json_decode( $output, true );

        return $location_result['results'];
    }

    // GBIF Taxons
    public function getGbifTaxons($input)
    {
        $gbif_id = $this->getGbif($input);
        $url = "https://api.gbif.org/v1/species/" . $gbif_id;
        // Init curl
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $result = json_decode( $output, true );
        return $result;
    }

    // Gets the url of the wikipedia page image
    public function getWiki($input)
    {
        $gbif_name = $this->getGbifCanonicalName($input);
        // $gbif_name = "Abies alba";
        // Set the endpoint & parameters
        $endPoint = "https://en.wikipedia.org/w/api.php";
        $params = [
            "action" => "query",
            "prop" => "pageimages",
            "format" => "json",
            "pithumbsize" => "1000",
            "origin" => "*",
            "redirects" => "1",
            "titles" => $gbif_name
        ];
        // Combine endpoint & parameters
        $url = $endPoint . "?" . http_build_query( $params );
        // Init curl
        $ch = curl_init( $url );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec( $ch );
        curl_close( $ch );
        // Decode result
        $result = json_decode( $output, true );
        // Get pages from wikipedia API
        $page = $result["query"]["pages"];
        // Loop through pages
        foreach( $page as $k => $v ) {
            // Check if there is a thumbnail
            if( isset($v["thumbnail"]) )
            {
                // Loop through thumbnails
                foreach( $v["thumbnail"] as $k => $v ) {
                    $wiki_image = $v;
                    // Return the first page image
                    return $wiki_image;
                }
            }
        };
    }

    // Enumerate pollinators
    public function enumeratePollinators($input)
    {
        $trimmed = str_replace(' ','',$input);
        $array = explode(",", strtoupper($trimmed));
        return $array;
    }

    // Enumerate different regions
    public function enumerateRegions($input)
    {
        // TODO
        // merge values containing the same letter (e.g. NW goes to both N and W instead of NW)
        if($input)
        {
            $regions_array = array();
            $trimmed = str_replace(' ','',$input);
            $base_array = explode(",", $trimmed);

            $return_array = array();
            foreach($base_array as $param)
            // returns params in created array
            {
                // Exceptions to one lettered regions within pf db
                // Chili and China
                if($param == 'Ch')
                {
                    array_push($return_array, $param);
                    // reset param
                    $param = null;
                };
                // Australia duplicate
                if($param == 'a')
                {
                    array_push($return_array, 'A');
                    // reset param
                    $param = null;
                };
                // New Zealand duplicate
                if($param == 'NZ')
                {
                    array_push($return_array, 'N');
                    // reset param
                    $param = null;
                }
                // change the string to an array
                $letter_array = str_split($param);
                // parse out the letters for each value
                foreach($letter_array as $letter)
                {
                    if(!in_array($letter, $return_array))
                    {
                        array_push($return_array, $letter);
                    };
                }
            };
            // remove empty values from array
            $return_array = array_filter($return_array);
            return $return_array;
        }
    }

    // Grabs the different cultivars
    public function getCultivars($input)
    {
        // return if no cultivars
        if(!$input){ return; };
        // look up the different cultivars with the same latin name
        $cultivars_list = Cultivar::where('Latin Name', $input)->get()->toArray();
        // returns a parenthesized array, e.g. 'Latin name': 'Abelmoschus esculentus', instead of latin_name: 'Abelmoschus esculentus'

        // Do something about the parentheses in this collection
        $parsed_cultivars_list = array();
        foreach($cultivars_list as $cultivar)
        {
            $new_cultivar = array_combine(
                [
                    // 'latin_name',
                    'cultivar_name',
                    'notes_on_cultivar',
                    'synonyms',
                    // "Pull Out" From PF might mean to pull it out of the db?
                    // 'pull_out',
                    'record_checked'
                ],
                [
                    // $cultivar['Latin Name'],
                    // remove parentheses from the cultivar name
                    trim($cultivar['Cultivar'], '\''),
                    $cultivar['Notes on cultivar'],
                    $cultivar['Synonyms'],
                    // $cultivar['Pull out'],
                    $cultivar['Record checked']
                ]
            );
            // add new keys to the array
            array_push($parsed_cultivars_list, $new_cultivar);
        }

        // Return the list of cultivars
        return $parsed_cultivars_list;
    }

    // Grabs the different medicinal uses
    public function enumerateMedicinalUses($input)
    {
        $medicinal_uses_list = Medicinal::where('Latin Name', $input)->get()->toArray();
        $enumerated_list = array();
        foreach($medicinal_uses_list as $value)
        {
            $list_item = strtoupper($value['Use']);
            array_push($enumerated_list, $list_item);
        };
        
        return $enumerated_list;
    }

    // Grabs the different edible uses
    public function enumerateEdibleUses($input)
    {
        $edible_uses_list = Edible::where('Latin Name', $input)->get()->toArray();
        $enumerated_list = array();
        foreach($edible_uses_list as $value)
        {
            $list_item = strtoupper($value['Use']);
            array_push($enumerated_list, $list_item);
        };
        
        return $enumerated_list;
    }

    // Grabs the different other uses
    public function enumerateOtherUses($input)
    {
        $other_uses_list = Other::where('Latin Name', $input)->get()->toArray();
        $enumerated_list = array();
        foreach($other_uses_list as $value)
        {
            $list_item = strtoupper(str_replace(' ', '_',$value['Use']));
            array_push($enumerated_list, $list_item);
        };
        
        return $enumerated_list;
    }

    public function getBotanicalReferences($input)
    {
        // regex matching
        preg_match_all("/\\[(.*?)\\]/", $input['Medicinal'], $medicinal);
        preg_match_all("/\\[(.*?)\\]/", $input['Range'], $region);
        preg_match_all("/\\[(.*?)\\]/", $input['Habitat'], $habitat);
        preg_match_all("/\\[(.*?)\\]/", $input['hazards'], $hazards);
        preg_match_all("/\\[(.*?)\\]/", $input['Synonyms'], $synonyms);
        preg_match_all("/\\[(.*?)\\]/", $input['cultivation_details'], $cultivation_details);
        preg_match_all("/\\[(.*?)\\]/", $input['Propagation 1'], $propagation);
        preg_match_all("/\\[(.*?)\\]/", $input['Edible uses'], $edible_uses);
        preg_match_all("/\\[(.*?)\\]/", $input['Uses notes'], $uses_notes);
        preg_match_all("/\\[(.*?)\\]/", $input['SiteSpecificNotes'], $site_specific_notes);

        // convert strings with multiple values to arrays
        // $medicinal = explode(',',$medicinal);

        // remove duplicates
        $medicinal = array_unique($medicinal[1], SORT_REGULAR);
        $region = array_unique($region[1], SORT_REGULAR);
        $habitat = array_unique($habitat[1], SORT_REGULAR);
        $hazards = array_unique($hazards[1], SORT_REGULAR);
        $synonyms = array_unique($synonyms[1], SORT_REGULAR);
        $cultivation_details = array_unique($cultivation_details[1], SORT_REGULAR);
        $propagation = array_unique($propagation[1], SORT_REGULAR);
        $edible_uses = array_unique($edible_uses[1], SORT_REGULAR);
        $uses_notes = array_unique($uses_notes[1], SORT_REGULAR);
        $site_specific_notes = array_unique($site_specific_notes[1], SORT_REGULAR);

        // create one array
        $references_list = array_merge(
            $medicinal,
            $region,
            $habitat,
            $hazards,
            $synonyms,
            $cultivation_details,
            $propagation,
            $edible_uses,
            $uses_notes,
            $site_specific_notes,
        );

        $publishable_array = array();
        // remove commas
        foreach($references_list as $reference)
        {
            $new_ref = explode(', ',$reference);
            foreach($new_ref as $v)
            {
                array_push($publishable_array, $v);
            }
        }
        // remove duplicates
        $trimmed_array = array_unique($publishable_array, SORT_REGULAR);
        // sort array
        sort($trimmed_array, SORT_REGULAR);
        return $trimmed_array;
    }

    public function getBookList($input)
    {
        $book_list = array();
        $naked_list = $this->getBotanicalReferences($input);
        foreach($naked_list as $value)
        {
            $book = Book::where('Number', $value)->first();
            if( $book )
            {
                $book = array_combine(
                    [
                        'id',
                        'title',
                        'author',
                    ],
                    [
                        $book['Number'],
                        $book['Title'],
                        $book['Author'],
                    ]
                );
                array_push($book_list, $book);
            };
        };
        // return enumerated booklist
        return $book_list;
    }

    // Shade preferences
    public function enumerateShadePreferences($input)
    {
        $shade_pref = str_split($input);
        $new_array = array();
        if(in_array('N', $shade_pref))
        {
            array_push($new_array, 'NO_SHADE');
        }
        if(in_array('S', $shade_pref))
        {
            array_push($new_array, 'SEMI_SHADE');
        }
        if(in_array('F', $shade_pref))
        {
            array_push($new_array, 'FULL_SHADE');
        }
        return $new_array;
    }

    // Moisture preferences
    public function enumerateMoisturePreferences($input)
    {
        $moisture_pref = str_split($input);
        $new_array = array();
        if(in_array('D', $moisture_pref))
        {
            array_push($new_array, 'DRY_SOIL');
        }
        if(in_array('M', $moisture_pref))
        {
            array_push($new_array, 'MOIST_SOIL');
        }
        if(in_array('e', $moisture_pref))
        {
            array_push($new_array, 'WET_SOIL');
        }
        if(in_array('a', $moisture_pref))
        {
            array_push($new_array, 'WATERY_SOIL');
        }
        return $new_array;
    }

    // Soil structure preferences
    public function enumerateSoilPreferences($input)
    {
        $soil_pref = str_split($input);
        $new_array = array();
        if(in_array('L', $soil_pref))
        {
            array_push($new_array, 'LIGHT_SOIL');
        }
        if(in_array('M', $soil_pref))
        {
            array_push($new_array, 'MEDIUM_SOIL');
        }
        if(in_array('H', $soil_pref))
        {
            array_push($new_array, 'HEAVY_SOIL');
        }
        return $new_array;
    }

    // Ph preference
    public function enumeratePhPreferences($input)
    {
        $ph = str_split($input);
        $new_array = array();
        if(in_array('A', $ph))
        {
            array_push($new_array, 'ACID');
        }
        if(in_array('N', $ph))
        {
            array_push($new_array, 'NEUTRAL');
        }
        if(in_array('B', $ph))
        {
            array_push($new_array, 'BASE');
        }
        return $new_array;
    }

    // Shade locations
    public function enumerateShadeLocations($input)
    {
        $shade_locations = array();
        if($input)
        {
            if($input['SunnyEdge'] == 1)
            {
                array_push($shade_locations, 'SUNNY_EDGE');
            };
            if($input['DappledShade'] == 1)
            {
                array_push($shade_locations, 'DAPPLED_SHADE');
            };
            if($input['ShadyEdge'] == 1)
            {
                array_push($shade_locations, 'SHADY_EDGE');
            };
            if($input['DeepShade'] == 1)
            {
                array_push($shade_locations, 'DEEP_SHADE');
            };
        };

        return $shade_locations;
    }

    // Enumerate the locations where true
    public function enumerateLocations($input)
    {
        $garden_locations = array();

        if($input)
        {
            if($input['WoodlandGarden'])
            {
                $location = 'WOODLAND';
                array_push($garden_locations, $location);
            };

            if($input['Meadow'])
            {
                $location = 'MEADOW';
                array_push($garden_locations, $location);
            };

            if($input['Walls'])
            {
                $location = 'WALL';
                array_push($garden_locations, $location);
            };

            if($input['Pond'])
            {
                $location = 'POND';
                array_push($garden_locations, $location);
            };

            if($input['BogGarden'])
            {
                $location = 'BOG';
                array_push($garden_locations, $location);
            };

            if($input['Hedge'])
            {
                $location = 'HEDGE';
                array_push($garden_locations, $location);
            };

            if($input['Hedgerow'])
            {
                $location = 'HEDGEROW';
                array_push($garden_locations, $location);
            };

            if($input['CultivatedBeds'])
            {
                $location = 'CULTIVATED_BEDS';
                array_push($garden_locations, $location);
            };

            if($input['OtherHabitats'])
            {
                $location = 'OTHER_HABITATS';
                array_push($garden_locations, $location);
            };
        };
        return $garden_locations;
    }

    public function enumerateLayers($location_input, $specy_input)
    {
        $garden_layers = array();

        // standard permaculture layers
        if($location_input)
        {
            // Canopy
            if($location_input['Canopy'])
            {
                $layer = 'CANOPY';
                array_push($garden_layers, $layer);
            };

            // Sub Canopy
            if($location_input['Secondary'])
            {
                $layer = 'SUB_CANOPY';
                array_push($garden_layers, $layer);
            };
            
            // Ground Cover
            if($location_input['GroundCover'] || $specy_input == 'Fern')
            {
                $layer = 'GROUND_COVER';
                array_push($garden_layers, $layer);
            };
        };

        if($specy_input)
        {
            // Shrubs
            if($specy_input == 'Shrub' )
            {
                $layer = 'SHRUB';
                array_push($garden_layers, $layer);
            };

            // Herbaceous
            // TODO: Optimize herbaceous layer, probably some herbaceous plants with the perennial habit as well
            if($specy_input  == 'Biennial' || $specy_input == 'Annual' || $specy_input == 'Annual/Biennial' || $specy_input == 'Bulb' || $specy_input == 'Biennial/Perennial' || $specy_input == 'Annual/Perennial' || $specy_input == 'Annual Climber' || $specy_input == 'Biennial Climber')
            {
                $layer = 'HERBACEOUS';
                array_push($garden_layers, $layer);
            };

            // Climbers
            if($specy_input == 'Climber' || $specy_input == 'Biennial Climber' || $specy_input == 'Annual Climber' || $specy_input == 'Perennial Climber')
            {
                $layer = 'CLIMBER';
                array_push($garden_layers, $layer);
            };
        };

        // Other layers
        if($location_input)
        {
            // Water plant
            if($location_input['Pond'])
            {
                $layer = 'WATER_PLANT';
                array_push($garden_layers, $layer);
            };

            // Bog plant
            if($location_input['BogGarden'])
            {
                $layer = 'BOG_PLANT';
                array_push($garden_layers, $layer);
            };
        };

        return $garden_layers;
    }
}
