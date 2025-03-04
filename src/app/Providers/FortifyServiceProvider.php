<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Redirect;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 🔹 Fortify のログイン画面を指定
        Fortify::loginView(function () {
            return view('auth.login'); // `resources/views/auth/login.blade.php`
        });

        // 🔹 Fortify の登録画面を指定
        Fortify::registerView(function () {
            return view('auth.register'); // `resources/views/auth/register.blade.php`
        });

        // 🔹 Fortify のユーザー登録処理を CreateNewUser に委託
        Fortify::createUsersUsing(CreateNewUser::class);

        // ユーザー登録後に `/register/step2` にリダイレクト
        Fortify::redirects('register', '/register/step2');

        // 🔹 Fortify のログイン認証をカスタマイズ（バリデーションを適用）
        Fortify::authenticateUsing(function (Request $request) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // 認証処理（メールアドレス & パスワードが正しいかチェック）
            if (Auth::attempt($credentials)) {
                return Auth::user(); // 認証成功
            }

            return null; // 認証失敗
        });
    }
}
