<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class RelationsController extends Controller
{
    public function friendsIndex()
    {
        $relations = Auth::user()->getFriends();
        return view('relation.index', ['relations'=>$relations, 'tab_name'=>'フレンド一覧']);
    }

    public function receiversIndex()
    {
        $relations = Auth::user()->getReceivers();
        return view('relation.index', ['relations'=>$relations, 'tab_name'=>'申請中のユーザー']);
    }
    
    public function throwersIndex()
    {
        $relations = Auth::user()->getThrowers();
        return view('relation.index', ['relations'=>$relations, 'tab_name'=>'承認待ちのユーザー']);
    }

    // public function friendsIndex()
    // {
    //     $friends = Auth::user()->getFriends();
    //     return view('relation.friends_index', ['friends'=>$friends, 'tab_name'=>'フレンド一覧']);
    // }

    public function follow()
    {
        
    }

    public function unFollow()
    {

    }
}
