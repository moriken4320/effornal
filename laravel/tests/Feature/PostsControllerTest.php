<?php

namespace Tests\Feature;

use App\Post;
use App\Subject;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsControllerTest extends TestCase
{
    use RefreshDatabase;

    //## 全投稿一覧画面
    // 未ログイン時
    public function testGuestIndex()
    {
        $response = $this->get('/');

        $response->assertStatus(200)
            ->assertViewIs('post.index')
            ->assertSee('ユーザー登録')
            ->assertSee('ログイン')
            ->assertSee('科目名で投稿を検索');
    }

    // ログイン時
    public function testAuthIndex()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('/');

        $response->assertStatus(200)
            ->assertViewIs('post.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertSee('科目名で投稿を検索');
    }

    //## 投稿詳細画面
    // 未ログイン時
    public function testGuestShow()
    {
        $post = factory(Post::class)->create();

        $response = $this->get(route('posts.show', ['post'=>$post]));

        $response->assertStatus(200)
            ->assertViewIs('post.show')
            ->assertSee('ユーザー登録')
            ->assertSee('ログイン')
            ->assertDontSee('科目名で投稿を検索');
    }

    // ログイン時
    public function testAuthShow()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->get(route('posts.show', ['post'=>$post]));

        $response->assertStatus(200)
            ->assertViewIs('post.show')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertDontSee('科目名で投稿を検索');
    }

    //## 投稿作成画面
    // 未ログイン時
    public function testGuestNew()
    {
        $response = $this->get(route('posts.new'));

        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthNew()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get(route('posts.new'));

        $response->assertStatus(200)
            ->assertViewIs('post.new')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertDontSee('科目名で投稿を検索');
    }

    //## 投稿作成機能のテスト
    // 未ログイン時
    public function testGuestCreate()
    {
        $response = $this->post(route('posts.create'));

        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthCreate()
    {
        $user = factory(User::class)->create();

        $subject_name = 'subject_name';
        $study_time_hour = 1;
        $study_time_min = 0;
        $text = 'text';

        $response = $this->actingAs($user)->post(route('posts.create', [
            'name'            => $subject_name,
            'study_time_hour' => $study_time_hour,
            'study_time_min'  => $study_time_min,
            'text'            => $text,
        ]));

        // テストデータがDBに登録されているかテスト
        $this->assertDatabaseHas('subjects', [
            'name' => $subject_name,
        ]);
        $subject = Subject::where('name', $subject_name)->first();
        $this->assertDatabaseHas('posts', [
            'subject_id' => $subject->id,
            'text'       => $text,
            'user_id'    => $user->id,
        ]);

        $response->assertRedirect(route('users.show', ['user' => $user]));
    }

    //## 投稿編集画面
    // 未ログイン時
    public function testGuestEdit()
    {
        $post = factory(Post::class)->create();

        $response = $this->get(route('posts.edit', ['post'=>$post]));

        $response->assertRedirect(route('login'));
    }

    // ログイン & 自分の投稿ではない時
    public function testAuthNotContributorEdit()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->get(route('posts.edit', ['post'=>$post]));

        $response->assertRedirect('/');
    }

    // ログイン & 自分の投稿である時
    public function testAuthContributorEdit()
    {
        $post = factory(Post::class)->create();
        $user = $post->user;

        $response = $this->actingAs($user)->get(route('posts.edit', ['post'=>$post]));

        $response->assertStatus(200)
            ->assertViewIs('post.edit')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertDontSee('科目名で投稿を検索');
    }

    //## 投稿更新機能のテスト
    // 未ログイン時
    public function testGuestUpdate()
    {
        $post = factory(Post::class)->create();

        $response = $this->post(route('posts.update', ['post'=>$post]));

        $response->assertRedirect(route('login'));
    }

    // ログイン & 自分の投稿ではない時
    public function testAuthNotContributorUpdate()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $subject_name = 'subject_name';
        $study_time_hour = 1;
        $study_time_min = 0;
        $text = 'text';

        $response = $this->actingAs($user)->post(route('posts.update', [
            'name'            => $subject_name,
            'study_time_hour' => $study_time_hour,
            'study_time_min'  => $study_time_min,
            'text'            => $text,
            'post'            => $post,
        ]));

        // テストデータがDBに存在しないかテスト
        $this->assertDatabaseMissing('subjects', [
            'name' => $subject_name,
        ]);
        $this->assertDatabaseMissing('posts', [
            'text'    => $text,
            'user_id' => $user->id,
        ]);

        $response->assertRedirect('/');
    }

    // ログイン & 自分の投稿である時
    public function testAuthContributorUpdate()
    {
        $post = factory(Post::class)->create();
        $user = $post->user;

        $subject_name = 'subject_name';
        $study_time_hour = 1;
        $study_time_min = 0;
        $text = 'text';

        $response = $this->actingAs($user)->post(route('posts.update', [
            'name'            => $subject_name,
            'study_time_hour' => $study_time_hour,
            'study_time_min'  => $study_time_min,
            'text'            => $text,
            'post'            => $post,
        ]));

        // テストデータがDBに登録されているかテスト
        $this->assertDatabaseHas('subjects', [
            'name' => $subject_name,
        ]);
        $subject = Subject::where('name', $subject_name)->first();
        $this->assertDatabaseHas('posts', [
            'subject_id' => $subject->id,
            'text'       => $text,
            'user_id'    => $user->id,
        ]);

        $response->assertRedirect(route('posts.show', ['post' => $post]));
    }

    //## 投稿削除機能のテスト
    // 未ログイン時
    public function testGuestDestroy()
    {
        $post = factory(Post::class)->create();

        $response = $this->delete(route('posts.destroy', ['post'=>$post]));

        $response->assertRedirect(route('login'));
    }

    // ログイン & 自分の投稿ではない時
    public function testAuthNotContributorDestroy()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->delete(route('posts.destroy', [
            'post' => $post,
        ]));

        // テストデータがDBに登録されているかテスト
        $this->assertDatabaseHas('posts', [
            'id'      => $post->id,
            'text'    => $post->text,
            'user_id' => $post->user_id,
        ]);

        $response->assertRedirect('/');
    }

    // ログイン & 自分の投稿である時
    public function testAuthContributorDestroy()
    {
        $post = factory(Post::class)->create();
        $user = $post->user;

        $response = $this->actingAs($user)->delete(route('posts.destroy', [
            'post' => $post,
        ]));

        // テストデータがDBに存在しないかテスト
        $this->assertDatabaseMissing('posts', [
            'id'      => $post->id,
            'text'    => $post->text,
            'user_id' => $post->user_id,
        ]);

        $response->assertRedirect(route('users.show', ['user' => $user]));
    }

    //## 科目名自動補完機能のテスト
    // 未ログイン時
    public function testGuestComplement()
    {
        $response = $this->get('/subjects/complement');

        $response->assertRedirect(route('login'));
    }

    // ログイン時
    public function testAuthComplement()
    {
        $user = factory(User::class)->create();
        $subject = factory(Subject::class)->create();

        $response = $this->actingAs($user)->get('/subjects/complement', ['keyword'=>$subject->name]);

        $response->assertJson([['name'=>$subject->name]]);
    }

    //## いいね機能のテスト
    // 未ログイン時
    public function testGuestLike()
    {
        $post = factory(Post::class)->create();

        $response = $this->put(route('posts.like', ['post'=>$post]));

        $response->assertJsonMissing(['liked']);
    }

    // ログイン時 & いいねしていない状態の時
    public function testAuthLike()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->put(route('posts.like', ['post'=>$post]));

        $response->assertJson(['liked'=>true, 'count'=>$post->likes()->count()]);
    }

    // ログイン時 & いいねしてある状態の時
    public function testAuthUnLike()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();
        $post->likes()->attach($user->id);

        $response = $this->actingAs($user)->put(route('posts.like', ['post'=>$post]));

        $response->assertJson(['liked'=>false, 'count'=>$post->likes()->count()]);
    }

    //## 対象の投稿に対していいねしたユーザーリスト表示画面のテスト
    // 未ログイン時
    public function testGuestLikeIndex()
    {
        $post = factory(Post::class)->create();

        $response = $this->get(route('posts.likeIndex', ['post'=>$post]));

        $response->assertStatus(200)
            ->assertViewIs('like.index')
            ->assertSee('ユーザー登録')
            ->assertSee('ログイン')
            ->assertDontSee('科目名で投稿を検索');
    }

    // ログイン時
    public function testAuthLikeIndex()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create();

        $response = $this->actingAs($user)->get(route('posts.likeIndex', ['post'=>$post]));

        $response->assertStatus(200)
            ->assertViewIs('like.index')
            ->assertSee('投稿する')
            ->assertSee('header-user-icon')
            ->assertDontSee('科目名で投稿を検索');
    }

    //## 投稿検索機能のテスト
    public function testGuestPostSearch()
    {
        for ($i = 0; $i < 2; $i++) {
            factory(Post::class)->create();
        }

        $response = $this->get('/');

        $response->assertSessionHas('posts');

        $response = $this->get(route('postSearch', ['post_search'=>'test']));

        $response->assertRedirect('/')
            ->assertSessionHas('query_posts')
            ->assertSessionHas('post_search');
    }
}
