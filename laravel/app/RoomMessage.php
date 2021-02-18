<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RoomMessage extends Model
{
    protected $fillable = [
        'message',
    ];

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
