<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
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
    
    public function create(PostRequest $request)
    {
        // Subjectモデルの作成
        $subject = Subject::firstOrCreate(['name'=>$request->name]);

        // Postモデル作成
        $post = new Post;
        $post->subject_id = $subject->id;
        $post->study_time = $request->study_time;
        $post->text = $request->text;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect(route("users.show",Auth::user()->id));
    }
    
    public function edit($post_id)
    {
        $post = Post::find($post_id);
        return view('post.edit', ['post'=>$post]);
    }

    public function update($post_id, PostRequest $request)
    {
        // Subjectモデルの作成
        $subject = Subject::firstOrCreate(['name'=>$request->name]);

        // Postデータ取得
        $post = Post::find($post_id);
        $post->subject_id = $subject->id;
        $post->study_time = $request->study_time;
        $post->text = $request->text;
        $post->save();

        return redirect(route("users.show",Auth::user()->id));
    }

    public function destroy($post_id)
    {
        $post = Post::find($post_id);
        $post->delete();
        return redirect()->back();
    }

    // 科目名自動補完用アクション
    public function Complement($keyword)
    {
        $subjects = Subject::where('name', 'like', '%' . $keyword . '%')->get()->map(function($subject){
            return ['name'=>$subject->name];
        });
        return response()->json($subjects);
    }
}
