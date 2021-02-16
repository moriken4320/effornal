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

    public function searchUsersIndex(Request $request)
    {
        if($request->search == null){
            return view('relation.index', ['relations'=>[], 'tab_name'=>'ユーザー検索']);
        }

        $relations = User::where('name', 'like', '%' . $request->search . '%')->get()->map(function($relation){
            if($relation != Auth::user()){
                return $relation;
            }
        })->reject(function ($relation) {
            return $relation == null;
        });
        return view('relation.index', ['relations'=>$relations, 'tab_name'=>'ユーザー検索', 'search'=>$request->search]);
        // return redirect()->back()->withInput()->with(['relations'=>$relations, 'tab_name'=>'ユーザー検索']);
    }

    public function follow(User $user)
    {
        if(Auth::user() == $user){
            return redirect()->back();
        }
        Auth::user()->receivers()->detach($user);
        Auth::user()->receivers()->attach($user);
        $f_message = '';
        if(Auth::user()->friendCheck($user)){
            $f_message = 'フレンドに追加しました';
        }else{
            $f_message = 'フレンド申請が完了しました';
        }
        return redirect()->back()->with('flash_message', $f_message);
    }
    
    public function unFollow(User $user)
    {
        Auth::user()->receivers()->detach($user);
        $f_message = '';
        if(Auth::user()->throwerCheck($user)){
            $f_message = 'フレンドを解除しました';
        }else{
            $f_message = 'フレンド申請を削除しました';
        }
        return redirect()->back()->with('flash_message', $f_message);
    }
}
