<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    //
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
