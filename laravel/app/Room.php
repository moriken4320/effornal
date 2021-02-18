<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //belongsToMany設定
    public function roomUsers()
    {
        return $this->belongsToMany('App\User', 'room_users');
    }

    //hasMany設定
    public function roomMessage()
    {
        return $this->hasMany('App\Room_Message');
    }
}
