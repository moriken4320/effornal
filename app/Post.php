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

    // belongsToの設定
    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }
}
