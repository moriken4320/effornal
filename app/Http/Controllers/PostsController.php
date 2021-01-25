<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Like;
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
    
    public function create(PostRequest $request, Post $post)
    {
        // Subjectモデルの作成
        $subject = Subject::firstOrCreate(['name'=>$request->name]);

        // Postモデル作成
        $post->fill($request->all());
        $post->subject_id = $subject->id;
        $post->user_id = Auth::user()->id;
        $post->save();

        return redirect(route("users.show",Auth::user()->id));
    }
    
    public function edit(Post $post)
    {
        return view('post.edit', ['post'=>$post]);
    }

    public function update(PostRequest $request, Post $post)
    {
        // 編集前のSubject
        $before_subject = $post->subject;

        // 編集後のSubject
        $after_subject = Subject::firstOrCreate(['name'=>$request->name]);

        // Postデータ取得
        $post->fill($request->all());
        $post->subject_id = $after_subject->id;
        $post->save();
        // 該当の科目名が使用されていなければデータベースから削除
        if(Post::where('subject_id',$before_subject->id)->count() <= 0){
            $before_subject->delete();
        }

        return redirect(route("users.show",Auth::user()->id));
    }

    public function destroy(Post $post)
    {
        $subject = $post->subject;
        $post->delete();
        // 該当の科目名が使用されていなければデータベースから削除
        if(Post::where('subject_id',$subject->id)->count() <= 0){
            $subject->delete();
        }
        return redirect()->back();
    }

    // 科目名自動補完用アクション
    public function Complement(Request $request)
    {
        $subjects = Subject::where('name', 'like', '%' . $request->keyword . '%')->get()->map(function($subject){
            return ['name'=>$subject->name];
        });
        return response()->json($subjects);
    }

    // いいね関連
    public function like(Request $request)
    {
        // ログインしていない場合、空のjsonを返す
        if(!Auth::check()){
            return response()->json();
        }

        $user_id = Auth::user()->id;
        $post = Post::find($request->post_id);
        $user_liked = $post->likes()->where('user_id', $user_id)->first();
        
        // 該当の投稿に「いいね」をしていたら削除し、していなければ「いいね」する
        if($user_liked){
            $user_liked->delete();
            $data = ['liked'=>false, 'count'=>$post->likes()->count()];
        }else{
            Like::create(['user_id'=>$user_id, 'post_id'=>$post->id]);
            $data = ['liked'=>true, 'count'=>$post->likes()->count()];
        }
        return response()->json($data);
    }
}
