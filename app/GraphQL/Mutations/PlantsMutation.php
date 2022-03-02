<?php

namespace App\GraphQL\Mutations;

use App\Models\Plant;

class PlantsMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function createPlant($_, array $args)
    {
        $input = $args['createPlantInput'];
        // current amount of plants. 
        $plants_count = Plant::count();
        $new_plant = Plant::create([
            'id' => $plants_count+1,
            'name' => $input['name'] ?? null,
            'description' => $input['description'] ?? null,
            'location' => $input['location'] ?? null,
            'soil' => $input['soil'] ?? null,
            'planting_date' => $input['planting_date'] ?? null,
            // TODO make input specy for plants that are not yet in the pf database
            'specy_id' => $input['specy_id'] ?? null,
            'guild_id' => $input['guild_id'] ?? null,
            'keystone' => $input['keystone'] ?? false,
        ]);

        return $new_plant;
    }

    public function updatePlant($_, array $args)
    {
        $input = $args['updatePlantInput'];
        $plant_id = intval($input['id']);
        $selected_plant = Plant::where('id', $plant_id)->first();

        $selected_plant->update([
            'name' => $input['name'] ?? $selected_plant['name'],
            'description' => $input['description'] ?? $selected_plant['description'],
            'location' => $input['location'] ?? $selected_plant['location'],
            'soil' => $input['soil'] ?? $selected_plant['soil'],
            'planting_date' => $input['planting_date'] ?? $selected_plant['planting_date'],
            'specy_id' => $input['specy_id'] ?? $selected_plant['specy_id'],
            'guild_id' => $input['guild_id'] ?? $selected_plant['guild_id'],
            'keystone' => $input['keystone'] ?? $selected_plant['keystone'],
        ]);
        
        return $selected_plant;
    }

    public function deletePlant($_, array $args)
    {
        $plant_id = intval($args['id']);
        Plant::where('id', $plant_id)->delete();
        return;
    }
}
