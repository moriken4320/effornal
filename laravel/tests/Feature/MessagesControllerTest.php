<?php

namespace Tests\Feature;

use App\Room;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MessagesControllerTest extends TestCase
{
    use RefreshDatabase;

    //## メッセージ画面のテスト
    // 未ログイン時
    public function testGuestIndex()
    {
        $room = factory(Room::class)->create();

        $response = $this->get(route('rooms.messages.index', ['room'=>$room]));

        $response->assertRedirect(route('login'));
    }

    // ログイン時 & 自分のルームではない時
    public function testAuthNotMineIndex()
    {
        $user = factory(User::class)->create();
        $other_user1 = factory(User::class)->create();
        $other_user2 = factory(User::class)->create();

        $room = factory(Room::class)->create();
        $room->users()->attach($other_user1->id);
        $room->users()->attach($other_user2->id);

        $response = $this->actingAs($user)->get(route('rooms.messages.index', ['room'=>$room]));

        $response->assertRedirect('/');
    }

    // ログイン時 & 自分のルームである時
    public function testAuthMineIndex()
    {
        $user = factory(User::class)->create();
        $other_user = factory(User::class)->create();

        $room = factory(Room::class)->create();
        $room->users()->attach($user->id);
        $room->users()->attach($other_user->id);

        $response = $this->actingAs($user)->get(route('rooms.messages.index', ['room'=>$room]));

        $response->assertStatus(200)
            ->assertViewIs('room.message.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertSee($other_user->name)
            ->assertDontSee('科目名で投稿を検索');
    }

    //## メッセージ作成機能のテスト
    // 未ログイン時
    public function testGuestCreate()
    {
        $room = factory(Room::class)->create();

        $response = $this->post(route('rooms.messages.create', ['room'=>$room]));

        $response->assertRedirect(route('login'));
    }

    // ログイン時 & 自分のルームではない時
    public function testAuthNotMineCreate()
    {
        $user = factory(User::class)->create();
        $other_user1 = factory(User::class)->create();
        $other_user2 = factory(User::class)->create();

        $room = factory(Room::class)->create();
        $room->users()->attach($other_user1->id);
        $room->users()->attach($other_user2->id);

        $message = 'message';

        $response = $this->actingAs($user)->post(route('rooms.messages.create', ['room'=>$room, 'message'=>$message]));

        $response->assertRedirect('/');
    }

    // ログイン時 & 自分のルームである時
    public function testAuthMineCreate()
    {
        $user = factory(User::class)->create();
        $other_user = factory(User::class)->create();

        $room = factory(Room::class)->create();
        $room->users()->attach($user->id);
        $room->users()->attach($other_user->id);

        $message = 'message';

        $response = $this->actingAs($user)->post(route('rooms.messages.create', ['room'=>$room, 'message'=>$message]));

        $this->assertDatabaseHas('room_messages', [
            'message' => $message,
        ]);

        $response->assertJson(['message'=>$message]);
    }
}
