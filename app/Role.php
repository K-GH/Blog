<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
       public function user()
    {
    	//Many-To-Many
        //Role is Model , user_role is migration Table and is bradge
        return $this->belongsToMany('App\User','user_role','role_id','user_id');
    }
}
