<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //hasMany設定
    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    //belongsToMany設定
    public function likes()
    {
        return $this->belongsToMany('App\Post', 'likes');
    }

    //belongsToMany設定
    // ログインユーザーにフレンド申請を投げているユーザー
    public function throwers()
    {
        return $this->belongsToMany('App\User', 'relations', 'receive_id', 'throw_id');
    }

    //belongsToMany設定
    // ログインユーザーからフレンド申請を受けているユーザー
    public function receivers()
    {
        return $this->belongsToMany('App\User', 'relations', 'throw_id', 'receive_id');
    }

    // フレンドを取得
    public function getFriends()
    {
        $throwers = $this->throwers;
        $receivers = $this->receivers;
        $friends = collect();
        $throwers->each(function ($thrower) use ($receivers, $friends){
            if($receivers->contains($thrower)){
                $friends->push($thrower);
            }
        });
        return $friends;
    }

    // ログインユーザーにフレンド申請しているユーザーを取得
    public function getThrowers()
    {
        $throwers = collect();
        $this->throwers->each(function($t) use ($throwers){
            if(!$this->receivers->contains($t)){
                $throwers->push($t);
            }
        });
        return $throwers;
    }

    // ログインユーザーがフレンド申請しているユーザーを取得
    public function getReceivers()
    {
        $receivers = collect();
        $this->receivers->each(function($r) use ($receivers){
            if(!$this->throwers->contains($r)){
                $receivers->push($r);
            }
        });
        return $receivers;
    }
}
