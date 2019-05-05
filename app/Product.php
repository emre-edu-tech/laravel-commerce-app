<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
	use SoftDeletes;
	
    public function category(){
    	return $this->belongsTo('App\Category');
    }

    public function packagetype(){
        return $this->belongsTo('App\PackageType', 'package_type_id');
    }

    public function boxtype(){
        return $this->belongsTo('App\BoxType', 'box_type_id');
    }
}
