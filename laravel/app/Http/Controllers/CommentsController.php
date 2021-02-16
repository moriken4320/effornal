<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentsController extends Controller
{
    public function create(CommentRequest $request, Post $post)
    {
        $comment = new Comment;
        $comment->fill($request->all());
        $comment->post_id = $post->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return redirect(route("posts.show",$post))->with('flash_message', 'コメントを投稿しました');
    }
}
