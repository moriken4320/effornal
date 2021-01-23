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

    // 引数に指定したユーザーの投稿データを取得
    public static function getTargetOfPosts($user)
    {
        return self::where('user_id', $user->id)->with('user')->with('subject');
    }
}
