<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scented extends Model
{
    use HasFactory;
    protected $connection = 'mysql2';
	public $table = 'scentedplants';
}
