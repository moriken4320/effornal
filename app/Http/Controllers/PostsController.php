<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::with('user')->with('subject')->get();
        return view('post.index', ['posts'=>$posts]);
    }
}
