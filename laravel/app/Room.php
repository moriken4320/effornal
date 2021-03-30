<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    //belongsToMany設定
    public function users()
    {
        return $this->belongsToMany('App\User', 'room_users');
    }

    //hasMany設定
    public function roomMessage()
    {
        return $this->hasMany('App\RoomMessage');
    }

    // ルームのユーザーかチェック
    public function roomUserCheck(User $myself) :bool
    {
        $check_flag = false;
        $this->users->each(function ($user) use ($myself, &$check_flag) {
            if ($user->id == $myself->id) {
                $check_flag = true;
            }
        });

        return $check_flag;
    }

    // メッセージの相手を取得
    public function getOpponent(User $myself)
    {
        $opponent_users = $this->users->map(function ($user) use ($myself) {
            if ($user->id != $myself->id) {
                return $user;
            }
        })->reject(function ($user) {
            return $user == null;
        });

        return $opponent_users->first();
    }
}
