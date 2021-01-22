<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // hasOneの設定
    public function post()
    {
        return $this->hasOne('App\Post');
    }
}
