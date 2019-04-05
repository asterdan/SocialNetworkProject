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


    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function images()
    {
        return $this->hasMany('App\Image');
    }

    public function aboutmes()
    {
        return $this->hasMany('App\AboutMe');
    }

    public function friends()
    {
        return $this->hasMany('App\Friend');
    }

    public function friendrequests()
    {
        return $this->hasMany('App\FriendRequest');
    }

    public function userimages()
    {
        return $this->hasMany('App\UserImage');
    }

}
