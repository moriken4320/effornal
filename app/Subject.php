<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    // 複数代入する属性
    protected $fillable = ['name'];

    // hasOneの設定
    public function post()
    {
        return $this->hasOne('App\Post');
    }
}
