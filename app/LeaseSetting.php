<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeaseSetting extends Model{

    public function leases(){
    	return $this->hasMany('App\Lease');
  	}    
}
