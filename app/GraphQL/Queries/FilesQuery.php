<?php

namespace App\GraphQL\Queries;

class FilesQuery
{
    /**
     * @param  null  $_
     * @param  array<integer, mixed>  $args
     */
    public function byPlant($_, array $args)
    {
				$plant_id = $args['plant_id'];
        return \App\Models\File::where('plant_id', $plant_id)->get();
    }
}
