<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    ### ユーザー詳細画面のテスト

    // 未ログイン時
    public function testGuestShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', ['user' => $user]));

        $response->assertStatus(200)->assertViewIs('user.show');
    }

    // ログイン時
    public function testAuthShow()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.show', ['user' => $user]));

        $response->assertStatus(200)->assertViewIs('user.show');
    }


    ### ユーザー編集画面のテスト

    // 未ログイン時
    public function testGuestEdit()
    {
        $response = $this->get(route('users.edit'));
        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthEdit()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.edit'));

        $response->assertStatus(200)->assertViewIs('user.edit');
    }


    ### ユーザー編集画面のテスト

    // 未ログイン時
    public function testGuestUpdate()
    {
        $response = $this->post(route('users.update'));
        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthUpdate()
    {
        $user = factory(User::class)->create();

        $name = 'test';

        $response = $this->actingAs($user)->post(route('users.update',[
            'name' => $name,
        ]));

        // テストデータがDBに登録されているかテスト
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'id' => $user->id
        ]);

        $response->assertRedirect(route('users.show', ['user' => $user]));
    }


    ### ログインユーザーがいいねした投稿を表示する画面のテスト

    // 未ログイン時
    public function testGuestLikedPosts()
    {
        $response = $this->get(route('users.likedPosts'));
        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthLikedPosts()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.likedPosts'));

        $response->assertStatus(200)->assertViewIs('user.show', ['user' => $user]);
    }

    ### ランキング画面のテスト

    // 未ログイン時
    public function testGuestRanking()
    {
        $response = $this->get(route('ranking'));
        $response->assertStatus(200)->assertViewIs('ranking.index');
    }

    // ログイン時
    public function testAuthRanking()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('ranking'));

        $response->assertStatus(200)->assertViewIs('ranking.index');
    }
}
