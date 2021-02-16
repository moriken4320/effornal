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

Route::prefix('posts')->name('posts.')->group(function (){
    // いいね機能
    Route::put('/{post}/like', 'PostsController@like')->name('like');
    // 投稿詳細
    Route::get('/{post}/show', 'PostsController@show')->name('show');
    // 該当する投稿にいいねしたユーザー表示
    Route::get('/{post}/like_index', 'PostsController@likeIndex')->name('likeIndex');
  });

// 投稿関連
Route::group(['middleware' => 'auth'], function () {
    // 投稿作成画面
    Route::get('/posts', 'PostsController@new')->name('posts.new');
    // 投稿作成
    Route::post('/posts', 'PostsController@create')->name('posts.create')->middleware('studyTimeCalc');
    // 投稿編集画面
    Route::get('/posts/{post}/edit', 'PostsController@edit')->name('posts.edit')->middleware('contributor');
    // 投稿更新
    Route::post('/posts/{post}', 'PostsController@update')->name('posts.update')->middleware('contributor')->middleware('studyTimeCalc');
    // 投稿削除
    Route::delete('/posts/{post}', 'PostsController@destroy')->name('posts.destroy')->middleware('contributor');
    // 科目名自動補完
    Route::get('/subjects/complement', 'PostsController@Complement');
    // コメント作成
    Route::post('/posts/{post}/comment', 'CommentsController@create')->name('comment.create');
});

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
Route::get('/home', 'PostsController@index')->name('home');

// ユーザー情報編集
Route::get('users/edit', 'UsersController@edit')->name('users.edit')->middleware('auth');;

// ユーザー情報更新
Route::post('users/update', 'UsersController@update')->name('users.update')->middleware('auth');

// ユーザー詳細
Route::get('users/{user_id}', 'UsersController@show')->name('users.show');

// リレーション関連
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