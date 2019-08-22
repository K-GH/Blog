<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{


    public function likes()
    {
        return $this->hasMany(Like::class);
    }




    public function roles()
    {
        //Many-To-Many
        //Role is Model , user_role is migration Table
        return $this->belongsToMany('App\Role','user_role','user_id','role_id');
    }

    //roles is variable maybe array or not
    public function hasAnyRole($roles)
    {    
        //if role has many user   
        if (is_array($roles)) {
           foreach ($roles as $role) {
                    //hasRole is custom function
                  if ($this->hasRole($role)) {
                      return true;
                  }
           }
        }
        //if role has one role
        else{

            if ($this->hasRole($roles)) {
                      return true;
                  }

        }

    }


    //check role in DB
    public function hasRole($role)
    {   
        if($this->roles()->where('name',$role)->first())
        {
            return true;
        }

        return false;
       
    }
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
