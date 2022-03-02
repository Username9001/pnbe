<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Other extends Model
{
    use HasFactory;
	
	protected $connection = 'mysql2';
	public $table = 'other use details';
	
	public function species()
	{
		return $this->belongsToMany(Specy::class);
	}
}
