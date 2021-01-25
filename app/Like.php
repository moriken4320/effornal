<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // belongsToの設定
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // belongsToの設定
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
