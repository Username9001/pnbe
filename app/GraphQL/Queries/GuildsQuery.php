<?php

namespace App\GraphQL\Queries;
use \App\Models\Guild;

class GuildsQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function guildById($_, array $args)
    {
        $guild = Guild::where('id', intval($args['id']))->first();

        return $guild;
    }

}
