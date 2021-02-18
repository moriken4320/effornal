<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 投稿一覧
Route::get('/', 'PostsController@index');

// 投稿関連
Route::prefix('posts')->name('posts.')->group(function (){

    // いいね機能
    Route::put('/{post}/like', 'PostsController@like')->name('like');
    // 投稿詳細
    Route::get('/{post}/show', 'PostsController@show')->name('show');
    // 該当する投稿にいいねしたユーザー表示
    Route::get('/{post}/like_index', 'PostsController@likeIndex')->name('likeIndex');

    // ログイン中のみ
    Route::group(['middleware' => 'auth'], function () {
        // 投稿作成画面
        Route::get('/', 'PostsController@new')->name('new');
        // 投稿作成
        Route::post('/', 'PostsController@create')->name('create')->middleware('studyTimeCalc');
        // 投稿編集画面
        Route::get('/{post}/edit', 'PostsController@edit')->name('edit')->middleware('contributor');
        // 投稿更新
        Route::post('/{post}', 'PostsController@update')->name('update')->middleware('contributor')->middleware('studyTimeCalc');
        // 投稿削除
        Route::delete('/{post}', 'PostsController@destroy')->name('destroy')->middleware('contributor');
        // コメント作成
        Route::post('/{post}/comment', 'CommentsController@create')->name('comment');
    });
  });

// 科目名自動補完
Route::get('/subjects/complement', 'PostsController@Complement')->middleware('auth');

// ランキング
Route::get('/ranking', 'UsersController@ranking')->name('ranking');

// 投稿検索
Route::get('/post_search', 'PostsController@postSearch')->name('postSearch');

// ユーザー認証関連
Auth::routes();
Route::prefix('auth')->middleware('guest')->group(function() {
    Route::get('/{provider}', 'Auth\OAuthController@socialOAuth')
        ->where('provider','google')
        ->name('socialOAuth');
 
     Route::get('/{provider}/callback', 'Auth\OAuthController@handleProviderCallback')
         ->where('provider','google')
         ->name('oauthCallback');
 });

// ユーザー関連
Route::prefix('users')->name('users.')->group(function (){
    // ログイン中のみ
    Route::group(['middleware' => 'auth'], function () {
        // ログインユーザー情報編集
        Route::get('/edit', 'UsersController@edit')->name('edit');
        // ログインユーザー情報更新
        Route::post('/update', 'UsersController@update')->name('update');
        // ログインユーザーがいいねした投稿取得
        Route::get('/likes_posts', 'UsersController@likedPosts')->name('likedPosts');
    });
    // ユーザー詳細
    Route::get('/{user}', 'UsersController@show')->name('show');
});

// リレーション関連(ログイン中のみ)
Route::group(['middleware' => 'auth'], function () {
    // フレンド一覧表示
    Route::get('/friends', 'RelationsController@friendsIndex')->name('friends.index');
    // 申請中のユーザー表示
    Route::get('/receivers', 'RelationsController@receiversIndex')->name('receivers.index');
    // 承認待ちのユーザー表示
    Route::get('/throwers', 'RelationsController@throwersIndex')->name('throwers.index');
    // リレーション作成
    Route::put('/follow/{user}', 'RelationsController@follow')->name('relations.follow');
    // リレーション取り消し
    Route::delete('/un_follow/{user}', 'RelationsController@unFollow')->name('relations.unFollow');
    // ユーザー検索
    Route::get('/search', 'RelationsController@searchUsersIndex')->name('searchUsers.index');
});

// ダイレクトメッセージ関連(room,message)
Route::prefix('rooms')->name('rooms.')->group(function (){
    Route::group(['middleware' => 'auth'], function () {
        // ルーム一覧表示
        Route::get('/', 'RoomsController@index')->name('index');
        // メッセージルーム表示
        Route::get('{room}', 'MessagesController@index')->name('messages.index');
    });
});