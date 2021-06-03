<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{
    protected $table='tbl_programmes';
    protected $primaryKey='programme_id';
	public $timestamps = false;
}
