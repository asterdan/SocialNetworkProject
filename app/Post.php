<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function postimages()
    {
        return $this->hasMany('App\PostImage');
    }
}
