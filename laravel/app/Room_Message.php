<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room_Message extends Model
{
    // belongsToの設定
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // belongsToの設定
    public function room()
    {
        return $this->belongsTo('App\Room');
    }
}
