<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OldSpecy extends Model
{
    use HasFactory;
	
	protected $connection = 'mysql2';
	public $table = 'species database';
	
	// public function plants()
	// {
	// 	return $this->hasMany(Plant::class);
	// }
	// public function locations()
	// {
	// 	return $this->belongsToMany(Location::class);
	// }
}
