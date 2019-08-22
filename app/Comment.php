<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
	  //just  data safety
    protected $fillable =[
    	'body', 'post_id'
    ];

    
    public function post()
    {
    	return $this->belongsTo(Post::class);
    }
}
