<?php

namespace Tests\Feature;

use App\Room;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoomsControllerTest extends TestCase
{
    use RefreshDatabase;

    //## ルーム一覧画面のテスト
    // 未ログイン時
    public function testGuestIndex()
    {
        $response = $this->get(route('rooms.index'));

        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('rooms.index'));

        $response->assertStatus(200)
            ->assertViewIs('room.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertDontSee('科目名で投稿を検索');
    }

    //## ルーム作成画面のテスト
    // 未ログイン時
    public function testGuestNew()
    {
        $response = $this->get(route('rooms.new'));

        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthNew()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('rooms.new'));

        $response->assertStatus(200)
            ->assertViewIs('room.new')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertDontSee('科目名で投稿を検索');
    }

    //## ルーム作成機能のテスト
    // 未ログイン時
    public function testGuestCreate()
    {
        $other_user = factory(User::class)->create();

        $response = $this->put(route('rooms.create', ['user'=>$other_user]));

        $response->assertRedirect(route('login'));
    }

    // ログイン時 & 対象のユーザーとのルームが存在しない時
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();
        $other_user = factory(User::class)->create();

        $response = $this->actingAs($user)->put(route('rooms.create', ['user'=>$other_user]));

        $room = new Room;
        $other_user->rooms->each(function ($r) use (&$room, $user) {
            if ($r->roomUserCheck($user)) {
                $room = $r;
            }
        });

        $response->assertRedirect(route('rooms.messages.index', ['room'=>$room]));
    }

    // ログイン時 & 対象のユーザーとのルームが存在する時
    public function testAuthOverCreate()
    {
        $user = factory(User::class)->create();
        $other_user = factory(User::class)->create();

        $room = Room::create();
        $room->users()->attach($user->id);
        $room->users()->attach($other_user->id);

        $this->actingAs($user)->get(route('rooms.index'));

        $response = $this->actingAs($user)->put(route('rooms.create', ['user'=>$other_user]));

        $response->assertRedirect(route('rooms.index'));
    }
}
