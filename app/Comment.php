<?php

namespace MyBlog;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function user()
    {
    	return $this->belongsTo('MyBlog\User');
    }

    public function post()
    {
    	return $this->belongsTo('MyBlog\Post');
    }
}
