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

// 「いいね」関連
Route::post('/like', 'PostsController@like')->name('like');

// 投稿関連
Route::group(['middleware' => 'auth'], function () {
    // 投稿作成画面
    Route::get('/posts', 'PostsController@new')->name('posts.new');
    // 投稿作成
    Route::post('/posts', 'PostsController@create')->name('posts.create')->middleware('studyTimeCalc');
    // 投稿編集画面
    Route::get('/posts/{post_id}', 'PostsController@edit')->name('posts.edit')->middleware('contributor');
    // 投稿更新
    Route::post('/posts/{post_id}', 'PostsController@update')->name('posts.update')->middleware('contributor')->middleware('studyTimeCalc');
    // 投稿削除
    Route::delete('/posts/{post_id}', 'PostsController@destroy')->name('posts.destroy')->middleware('contributor');
    // 科目名自動補完
    Route::get('/subjects/complement', 'PostsController@Complement');
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