<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
	use SoftDeletes;

    public function parent(){
    	return $this->belongsTo('App\Category', 'parent_id')->where('parent_id', 0)->with('parent');
    }

    public function children(){
    	return $this->hasMany('App\Category', 'parent_id', 'id');
    }

    public function products(){
    	return $this->hasMany('App\Product', 'category_id');
    }
}
