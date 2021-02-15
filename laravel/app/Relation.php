<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Relation extends Model
{
    // belongsToの設定
    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
