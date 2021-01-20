<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //コンストラクタ （このクラスが呼ばれると最初にこの処理をする）
    public function __construct()
    {
        // ログインしていなかったらログインページに遷移する
        $this->middleware('auth');
    }

    public function show($user_id)
    {
        // マッチしたレコードの最初のレコードだけを返す。
        $user = User::find($user_id);

        // 該当のユーザーが存在しない場合、投稿一覧にリダイレクト
        if(!$user)
        {
            return redirect('/');
        }

        return view('user.show',['user'=>$user]);
    }
}
