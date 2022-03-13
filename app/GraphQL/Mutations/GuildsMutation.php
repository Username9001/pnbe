<?php

namespace App\GraphQL\Mutations;

use App\Models\Guild;
// use App\Models\Specy;

class GuildsMutation
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function createGuild($_, array $args)
    {
        $input = $args['createGuildInput'];
        $guilds_count = Guild::count();
        Guild::create([
            'id' => $guilds_count+1,
            'name' => $input['name'],
            'description' => $input['description'] ?? null,
            'location' => $input['location'] ?? null,
            'soil_structure' => $input['soil_structure'] ?? null,
            'soil_ph' => $input['soil_ph'] ?? null,
            'shade' => $input['shade'] ?? null,
        ]);

        return;
    }

    public function updateGuild($_, array $args)
    {
        $input = $args['updateGuildInput'];
        $guild_id = intval($args['id']);
        $selected_guild = Guild::where('id', $guild_id)->first();

        $selected_guild->update([
            'name' => $input['name'] ?? $selected_guild['name'],
            'description' => $input['description'] ?? $selected_guild['description'],
            'location' => $input['location'] ?? $selected_guild['location'],
            'soil_structure' => $input['soil_structure'] ?? $selected_guild['soil_structure'],
            'soil_ph' => $input['soil_ph'] ?? $selected_guild['soil_ph'],
            'shade' => $input['shade'] ?? $selected_guild['shade'],
        ]);

        return;
    }

    public function deleteGuild($_, array $args)
    {
        $guild_id = intval($args['id']);
        Guild::where('id', $guild_id)->delete();
        return;
    }
}
