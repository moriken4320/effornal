<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\PostRequest;
use App\Like;
use App\Post;
use App\Subject;
use Auth;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        if (session()->has('query_posts')) {
            $posts = session('query_posts');
        } else {
            $posts = Post::orderBy('created_at', 'desc')->with('user')->with('subject')->get();
            session(['posts'=>$posts]);
        }

        return view('post.index', ['posts'=>$posts, 'post_search'=>session('post_search')]);
    }

    public function new()
    {
        return view('post.new');
    }

    public function show(Post $post)
    {
        $comments = Comment::where('post_id', $post->id)->orderBy('created_at', 'desc')->with('user')->get();

        return view('post.show', ['post'=>$post, 'comments'=>$comments]);
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

        return redirect(route('users.show', Auth::user()))->with('flash_message', '投稿が完了しました');
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
        if (Post::where('subject_id', $before_subject->id)->count() <= 0) {
            $before_subject->delete();
        }

        return redirect(route('posts.show', $post))->with('flash_message', '更新が完了しました');
    }

    public function destroy(Post $post)
    {
        $subject = $post->subject;
        $post->delete();
        // 該当の科目名が使用されていなければデータベースから削除
        if (Post::where('subject_id', $subject->id)->count() <= 0) {
            $subject->delete();
        }

        return redirect(route('users.show', Auth::user()))->with('flash_message', '削除が完了しました');
    }

    // 科目名自動補完用アクション
    public function Complement(Request $request)
    {
        $subjects = Subject::where('name', 'like', '%' . $request->keyword . '%')->get()->map(function ($subject) {
            return ['name'=>$subject->name];
        });

        return response()->json($subjects);
    }

    // いいね関連
    public function like(Post $post)
    {
        // ログインしていない場合、空のjsonを返す
        if (! Auth::check()) {
            return response()->json();
        }

        $user = Auth::user();

        // // 該当の投稿に「いいね」をしていたら削除し、していなければ「いいね」する
        if ($post->isLikedBy($user)) {
            $post->likes()->detach($user->id);
            $data = ['liked'=>false, 'count'=>$post->likes()->count()];
        } else {
            $post->likes()->attach($user->id);
            $data = ['liked'=>true, 'count'=>$post->likes()->count()];
        }

        return response()->json($data);
    }

    // いいねしたユーザーリスト表示
    public function likeIndex(Post $post)
    {
        $users = $post->likes;

        return view('like.index', ['users'=>$users]);
    }

    // 投稿検索
    public function postSearch(Request $request)
    {
        $keyword = $request->post_search;

        if (! session()->has('posts')) {
            return redirect('/');
        }

        $query_posts = session('posts')->map(function ($post) use ($keyword) {
            if (preg_match('/' . mb_convert_kana(mb_strtolower($keyword), 'ASHc') . '/', mb_convert_kana(mb_strtolower($post->subject->name), 'ASHc')) > 0) {
                return $post;
            }
        })->reject(function ($post) {
            return $post == null;
        });

        return redirect(back()->getTargetUrl())->with('query_posts', $query_posts)->with('post_search', $keyword);
    }
}
