<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'comment',
    ];

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
