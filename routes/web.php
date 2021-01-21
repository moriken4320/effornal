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
Route::resource('/posts', 'PostsController')->except(['index','show'])->middleware('auth');

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