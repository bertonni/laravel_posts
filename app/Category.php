<?php

namespace MyBlog;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
    	return $this->belongsTo('MyBlog\Category');
    }
}
