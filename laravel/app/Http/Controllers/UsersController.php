<?php

namespace App\Http\Controllers;

use App\User;
use App\Post;
use App\Subject;
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

        // ユーザーの投稿データを取得
        $posts = Post::getTargetOfPosts($user)->orderBy('created_at','desc')->get();

        // 合計勉強時間を取得
        $sum_study_time = $posts->sum('study_time');
        
        // 1日あたりの最大勉強時間を取得
        // $max_study_time = $posts->max('study_time');
        
        // ユーザーが勉強した科目名と勉強時間を取得
        $subjects = Post::getTargetOfPosts($user)->select('subject_id')->distinct()->get()->map(function($post) use($user){
            $subject_sum_study_time = Post::getTargetOfPosts($user)->where('subject_id', $post->subject->id)->sum('study_time');
            return ["name"=>$post->subject->name, 'sum_study_time'=>$subject_sum_study_time];
        });

        // 科目と勉強時間関連のデータを格納
        $study_data = [
            'sum_study_time'=>$sum_study_time,
            // 'max_study_time'=>$max_study_time,
            'subjects'=>$subjects,
        ];

        return view('user.show',['user'=>$user, 'posts'=>$posts, 'study_data'=>$study_data]);
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
        if ($request->image !=null && $request->image->getFilename() != null) {
            // アップロードされた画像ファイルをbase64という形式に変換
            $user->image = base64_encode(file_get_contents($request->image));
        }
        $user->save();

        return redirect('/users/'.$user->id)->with('flash_message', 'ユーザー情報を更新しました');
    }
}
