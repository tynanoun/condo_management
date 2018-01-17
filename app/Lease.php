<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lease extends Model{

	public function Leasesetting(){
    	return $this->belongsTo('App\LeaseSetting');
  	}	
}
