<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Plant extends Model
{
	protected $collection = 'plants';
	
	protected $primaryKey = 'id';
	public $incrementing = true;
	
	public $fillable = [
		'id',
		'name',
		'description',
		'specy_id',
		'guild_id',
		'keystone'
	];

	public function specy()
	{
		return $this->belongsTo(Specy::class);
	}

	public function guild()
	{
		return $this->belongsTo(Guild::class);
	}
}