<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $table='tbl_department';
    protected $primaryKey='department_id';
	public $timestamps = false;
}
