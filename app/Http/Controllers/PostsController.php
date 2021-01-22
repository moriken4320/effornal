<?php

namespace App\Http\Controllers;

use App\Post;
use App\Subject;
use Auth;
use Validator;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->with('user')->with('subject')->get();
        return view('post.index', ['posts'=>$posts]);
    }

    public function new()
    {
        return view('post.new');
    }
    
    public function create(Request $request)
    {
        //バリデーション（入力値チェック）
        $validator = Validator::make($request->all(), [
            'subject_title' => 'required|string|max:15|unique:subjects',
            'study_time' => 'required|integer|min:1',
            'text' => 'required|string|max:250',
        ]);

        //バリデーションの結果がエラーの場合
        if ($validator->fails())
        {
          return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        // Subjectモデルの作成
        $subject = new Subject;
        $subject->name = $request->subject_title;
        $subject->save();

        // Postモデル作成
        $post = new Post;
        $post->subject_id = $subject->id;
        $post->study_time = $request->study_time;
        $post->text = $request->text;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect('/');
    }
    
    public function edit($post_id)
    {
        $post = Post::find($post_id);
        return view('post.edit', ['post'=>$post]);
    }

    public function update($post)
    {

    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->back();
    }
}
