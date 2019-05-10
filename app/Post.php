<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
	use SoftDeletes;

    public class postcategories(){
    	return $this->belongsToMany('App\PostCategory');
    }
}
