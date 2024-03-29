<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    use RefreshDatabase;

    //## ユーザー詳細画面のテスト

    // 未ログイン時
    public function testGuestShow()
    {
        $user = factory(User::class)->create();

        $response = $this->get(route('users.show', ['user' => $user]));

        $response->assertStatus(200)
        ->assertViewIs('user.show')
        ->assertSee('ユーザー登録')
        ->assertSee('ログイン')
        ->assertSee('科目名で投稿を検索');
    }

    // ログイン時
    public function testAuthShow()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('users.show', ['user' => $user]));

        $response->assertStatus(200)
        ->assertSee('投稿する')
        ->assertSee('header-user-icon')
        ->assertViewIs('user.show')
        ->assertSee('科目名で投稿を検索');
    }

    //## ユーザー編集画面のテスト

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

        $response->assertStatus(200)
        ->assertViewIs('user.edit');
    }

    //## ユーザー更新機能のテスト

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

        $response = $this->actingAs($user)->post(route('users.update', [
            'name' => $name,
        ]));

        // テストデータがDBに登録されているかテスト
        $this->assertDatabaseHas('users', [
            'name' => $name,
            'id'   => $user->id
        ]);

        $response->assertRedirect(route('users.show', ['user' => $user]));
    }

    //## ログインユーザーがいいねした投稿を表示する画面のテスト

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

        $response->assertStatus(200)
        ->assertViewIs('user.show', ['user' => $user])
        ->assertSee('投稿する')
        ->assertSee('header-user-icon')
        ->assertSee('科目名で投稿を検索');
    }

    //## ランキング画面のテスト

    // 未ログイン時
    public function testGuestRanking()
    {
        $response = $this->get(route('ranking'));
        $response->assertStatus(200)
        ->assertViewIs('ranking.index')
        ->assertSee('ユーザー登録')
        ->assertSee('ログイン')
        ->assertDontSee('科目名で投稿を検索');
    }

    // ログイン時
    public function testAuthRanking()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('ranking'));

        $response->assertStatus(200)
        ->assertViewIs('ranking.index')
        ->assertSee('投稿する')
        ->assertSee('header-user-icon')
        ->assertDontSee('科目名で投稿を検索');
    }
}
