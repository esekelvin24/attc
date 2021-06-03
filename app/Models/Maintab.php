<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintab extends Model
{
    protected $table='tbl_main_tab';
    protected $primaryKey='main_tab_id';
	public $timestamps = false;



    public function subtabs(){
     return $this->hasMany(Subtab::class,'main_tab_id');
    }
}
