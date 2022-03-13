<?php

namespace App\GraphQL\Queries;
use \App\Models\Plant;

class PlantsQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function plantById($_, array $args)
    {
        $plant = Plant::where('id', intval($args['id']))->first();

        return $plant;
    }

    public function plantsByName($_, array $args)
    {
        $plants = Plant::where('name', 'like', '%'.$args['name'].'%')->get();

        return $plants;
    }

    public function plantsByGuild($_, array $args)
    {
        $plants = Plant::where('guild_id', intval($args['guild_id']))->get();

        return $plants;
    }

    public function plantsBySpeciesSpecs($_, array $args)
    {
        $query = Plant::query();
        foreach ($args as $key => $value) {
            $query->where($key, 'like', '%'.$value.'%');
        }

        return $query->get();
    }

}
