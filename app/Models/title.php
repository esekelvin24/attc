<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class title extends Model
{
    use HasFactory;
    
    protected $table='titles';
    protected $primaryKey='title_id';
	public $timestamps = false;
}
