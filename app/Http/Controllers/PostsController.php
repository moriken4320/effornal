<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->with('user')->with('subject')->get();
        return view('post.index', ['posts'=>$posts]);
    }

    public function create()
    {
        return view('post.create');
    }
    
    public function store()
    {

    }
    
    public function edit($post)
    {
        $post_instance = Post::find($post);
        return view('post.edit', ['post'=>$post_instance]);
    }

    public function update($post)
    {

    }

    public function destroy($post)
    {
        $post_instance = Post::find($post);
        $post_instance->delete();
        return redirect()->back();
    }
}
