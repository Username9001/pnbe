<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Edible extends Model
{
    use HasFactory;
	
	protected $connection = 'mysql2';
	public $table = 'edible use details';
	
	public function species()
	{
		return $this->belongsToMany(Specy::class);
	}
}
