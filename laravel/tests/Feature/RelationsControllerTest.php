<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\User;

class RelationsControllerTest extends TestCase
{
    use RefreshDatabase;

    ### フレンド一覧画面
    // 未ログイン時
    public function testGuestFriendsIndex()
    {
        $response = $this->get(route('friends.index'));

        $response->assertRedirect(route('login'));
    }
    // ログイン時
    public function testAuthFriendsIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('friends.index'));

        $response->assertStatus(200)
            ->assertViewIs('relation.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertSee('フレンド一覧')
            ->assertDontSee('科目名で投稿を検索');
    }


    ### フレンド申請中のユーザー一覧画面
    // 未ログイン時
    public function testGuestReceiversIndex()
    {
        $response = $this->get(route('receivers.index'));

        $response->assertRedirect(route('login'));
    }
    // ログイン時
    public function testAuthReceiversIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('receivers.index'));

        $response->assertStatus(200)
            ->assertViewIs('relation.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertSee('申請中のユーザー')
            ->assertDontSee('科目名で投稿を検索');
    }


    ### フレンド承認待ちのユーザー一覧画面
    // 未ログイン時
    public function testGuestThrowersIndex()
    {
        $response = $this->get(route('throwers.index'));

        $response->assertRedirect(route('login'));
    }
    // ログイン時
    public function testAuthThrowersIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('throwers.index'));

        $response->assertStatus(200)
            ->assertViewIs('relation.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertSee('承認待ちのユーザー')
            ->assertDontSee('科目名で投稿を検索');
    }


    ### ユーザー検索画面
    // 未ログイン時
    public function testGuestSearchUsersIndex()
    {
        $response = $this->get(route('searchUsers.index'));

        $response->assertRedirect(route('login'));
    }
    // ログイン時
    public function testAuthSearchUsersIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('searchUsers.index'));

        $response->assertStatus(200)
            ->assertViewIs('relation.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertSee('ユーザー検索')
            ->assertDontSee('科目名で投稿を検索');
    }


    ### フレンド申請機能
    // 未ログイン時
    public function testGuestFollow()
    {
        $other_user = factory(User::class)->create();

        $response = $this->put(route('relations.follow',['user'=>$other_user]));

        $response->assertRedirect(route('login'));
    }
    // ログイン時
    public function testAuthFollow()
    {
        $user = factory(User::class)->create();
        $other_user = factory(User::class)->create();

        $this->get(route('friends.index'));

        $response = $this->actingAs($user)->put(route('relations.follow',['user'=>$other_user]));

        $response->assertRedirect(route('friends.index'))
        ->assertSessionHas('flash_message');
    }


    ### フレンド申請解除機能
    // 未ログイン時
    public function testGuestUnFollow()
    {
        $other_user = factory(User::class)->create();

        $response = $this->delete(route('relations.unFollow',['user'=>$other_user]));

        $response->assertRedirect(route('login'));
    }
    // ログイン時
    public function testAuthUnFollow()
    {
        $user = factory(User::class)->create();
        $other_user = factory(User::class)->create();
        $user->receivers()->attach($other_user);

        $this->get(route('friends.index'));

        $response = $this->actingAs($user)->delete(route('relations.unFollow',['user'=>$other_user]));

        $response->assertRedirect(route('friends.index'))
        ->assertSessionHas('flash_message');
    }
}
