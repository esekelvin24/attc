<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subtab extends Model
{
    protected $table='tbl_sub_tab';
    protected $primaryKey='sub_tab_id';
	public $timestamps = false;

    public function subertabs(){
      return $this->hasMany(Subertab::class,'sub_tab_id');
    }

   
}
