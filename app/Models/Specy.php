<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

// TODO 
// make placeholder specy for plants that are not yet in the pf database
class Specy extends Model
{
    // use HasFactory;
	
	// public $table = 'species_compact';

	protected $primaryKey = 'id';
	
	public function plants()
	{
		return $this->hasMany(Plant::class);
	}
}
