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
    public function followers()
    {
        return $this->belongsToMany('App\User', 'relations', 'following_id', 'follower_id');
    }

    //belongsToMany設定
    public function followings()
    {
        return $this->belongsToMany('App\User', 'relations', 'follower_id', 'following_id');
    }
}
