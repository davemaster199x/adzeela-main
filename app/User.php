<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'guid', 'username', 'user_role', 'is_activated', 'added_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function added_by()
    {
        return $this->hasMany('App\User');
    }

    public function login_id()
    {
        return $this->hasMany('App\User');
    }

    public function added_role_by()
    {
        return $this->hasMany('App\User');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    public function freelance()
    {
        return $this->hasMany('App\Freelancer');
    }
}
