<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostCategory extends Model
{
    use SoftDeletes;

    // parent child relationship
    public function parent(){
    	return $this->belongsTo('App\PostCategory', 'parent_category_id')->where('parent_category_id', 0)->with('parent');
    }

    public function children(){
    	return $this->hasMany('App\PostCategory', 'parent_category_id', 'id');
    }

    public function posts(){
    	return $this->hasMany('App\Post', 'postcategory_id');
    }
}
