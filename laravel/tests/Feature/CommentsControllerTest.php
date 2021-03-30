<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentsControllerTest extends TestCase
{
    use RefreshDatabase;

    //## コメント作成機能のテスト
    // 未ログイン時
    public function testGuestCreate()
    {
        $post = factory(Post::class)->create();

        $response = $this->post(route('posts.comment', ['post'=>$post]));

        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $comment = 'comment';

        $response = $this->actingAs($user)->post(route('posts.comment', ['post'=>$post, 'comment'=>$comment]));

        $response->assertRedirect(route('posts.show', $post));
    }
}
