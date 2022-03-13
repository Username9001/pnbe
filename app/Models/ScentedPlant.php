<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScentedPlant extends Model
{
		protected $connection = 'mysql2';
		public $table = 'scentedplants';
    use HasFactory;
}
