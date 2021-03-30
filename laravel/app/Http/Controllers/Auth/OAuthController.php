<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Auth;
use Socialite;

class OAuthController extends Controller
{
    /**
     * 各SNSのOAuth認証画面にリダイレクトして認証
     * @param string $provider サービス名
     * @return mixed
     */
    public function socialOAuth(string $provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * 各サイトからのコールバック
     * @param string $provider サービス名
     * @return mixed
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();
        $user = User::firstOrNew(['email' => $socialUser->getEmail()]);

        // すでに会員になっている場合の処理を書く
        if ($user->exists) {
            Auth::login($user);

            return redirect('/')->with('flash_message', 'ログインしました');
        }

        $user->name = $socialUser->getName();
        $user->provider_id = $socialUser->getId();
        $user->provider_name = $provider;
        $user->image = base64_encode(file_get_contents($socialUser->getAvatar()));
        $user->save();

        Auth::login($user);

        return redirect('/')->with('flash_message', 'ログインしました');
    }
}
