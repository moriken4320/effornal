<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // belongsToの設定
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // hasOneの設定
    public function subject()
    {
        return $this->hasOne('App\Subject');
    }
}
