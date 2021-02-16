<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use phpDocumentor\Reflection\Types\Boolean;

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

    //hasMany設定
    public function comments()
    {
        return $this->hasMany('App\Comment');
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

    // フレンドか判定
    public function friendCheck(User $user): bool
    {
        $flag = false;
        $this->getFriends()->each(function($value) use($user, &$flag){
            if($value->attributes == $user->attributes){
                $flag = true;
            }
        });
        return $flag;
    }

    // フレンド申請されているか(承認待ちか)判定
    public function throwerCheck(User $user): bool
    {
        $flag = false;
        $this->getThrowers()->each(function($value) use($user, &$flag){
            if($value->attributes == $user->attributes){
                $flag = true;
            }
        });
        return $flag;
    }
    
    // フレンド申請中か判定
    public function receiverCheck(User $user): bool
    {
        $flag = false;
        $this->getReceivers()->each(function($value) use($user, &$flag){
            if($value->attributes == $user->attributes){
                $flag = true;
            }
        });
        return $flag;
    }
}
