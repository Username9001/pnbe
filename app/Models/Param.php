<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class Param extends Model
{
	protected $collection = 'params';
	
	public $fillable = [
		'params'
	];

}