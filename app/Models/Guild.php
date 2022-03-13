<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Guild extends Model
{
	protected $primaryKey = 'id';

	public $fillable = [
		'id',
		'name',
		'description',
		'location',
		'soil_structure',
		'soil_ph',
		'shade'
	];
    // use HasFactory;
	public function plants()
	{
		return $this->hasMany(Plant::class);
	}
}
