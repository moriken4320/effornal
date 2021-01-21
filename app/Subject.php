<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // belongsToの設定
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
