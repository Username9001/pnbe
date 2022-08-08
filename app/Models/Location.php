<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends Model
{
    use HasFactory;
	
	protected $connection = 'mysql2';
	public $table = 'plantlocations';
	
	public function species()
	{
		return $this->belongsToMany(Specy::class);
	}
}
