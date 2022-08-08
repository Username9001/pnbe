<?php

namespace App\GraphQL\Queries;
use \App\Models\Specy;

class SpeciesQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    // MAIN QUERY
    public function complexSpecs($_, array $args, $count)
    {
        // TODO 
        // Replace nested if statements
        // Filter for parameters next to filtering for data type
        $query = Specy::query();
        // Loop through different value types
        $query_array = array();

        foreach ($args as $k => $v) {
            // if param is a number
            if (is_int($v) || is_bool($v) || is_float($v)) {
                // Check for individual parameters
                if($k == 'hardyness') {
                    // grab related hardyness zones (+, - 1)
                    array_push($query_array, 
                        [$k, '=', $v],
                    );
                    // array_push($query_array,
                    //     [$k, $v]
                    // );
                };
                // If no individual parameters
                array_push($query_array, [$k, $v]);
                // $query->where([$k, $v]);
            }
            // if param is a string 
            elseif(is_string($v)) {
                array_push($query_array, [$k, 'like', '%'.$v.'%']);
                // $query->where([$k, 'like', '%'.$v.'%']);
            }
            // if param is an array
            elseif(is_array($v)) {
                // Check for individual parameters
                // Garden Layers
                if($k == 'garden_layers') {
                    array_push($query_array, [$k, 'all', $v]);
                };
                // If no individual parameters
                array_push($query_array, [$k, 'all', $v]);
                // $query->where($query_array, [$k, 'all', $v]);
            }
        };

        // Execute the queries
        $count = 0;
        $array_length = count($query_array);
        foreach($query_array as $q)
        {
            $query
                ->where(
                    [
                        $query_array[$count]
                    ]
                );
            $count = $count+1;
            if($count == count($query_array) - 2)
            {
                return $query;
            };
        }
        return $query;
    }

    public function allSpecies($_, array $args)
    {
        $all_species = Specy::query()->orderBy('latin_name');
        
        return $all_species;
    }

    public function completedSpecies($_, array $args)
    {
        // check species for completion
        $completed_species = Specy::query()->where('completion_status', true)->orderBy('latin_name');
        
        return $completed_species;
    }

    public function incompleteSpecies($_, array $args)
    {
        // check species for completion
        $incomplete_species = Specy::query()->where('completion_status', false)->orderBy('latin_name');
        
        return $incomplete_species;
    }
}
