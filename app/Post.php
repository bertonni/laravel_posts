<?php

namespace MyBlog;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
    	return $this->belongsTo('MyBlog\User');
    }

    public function comments()
    {
    	return $this->hasMany('MyBlog\Comment');
    }

    public function category()
    {
    	return $this->hasMany('MyBlog\Post');
    }
}
