<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
	// one role can have many users
    public function users(){
    	return $this->hasMany('App\User', 'role_id');
    }
}
