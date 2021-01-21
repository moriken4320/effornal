<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Validator;
use Illuminate\Http\Request;

class UsersController extends Controller
{
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
    
    public function edit()
    {
        $user = Auth::user();
        return view('user.edit',['user'=>$user]);
    }

    public function update(Request $request)
    {
        //バリデーション（入力値チェック）
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:15',
        ]);

        //バリデーションの結果がエラーの場合
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user = Auth::user();
        $user->name = $request->name;
        if ($request->image !=null) {
            // アップロードされた画像ファイルをbase64という形式に変換
            $user->image = base64_encode(file_get_contents($request->image));
        }
        $user->save();

        return redirect('/users/'.$user->id);
    }
}
