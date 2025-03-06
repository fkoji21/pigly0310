<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Support\ServiceProvider;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        //Fortify のログイン画面を指定
        Fortify::loginView(function () {
            return view('auth.login'); //
        });

        //Fortify の登録画面を指定
        Fortify::registerView(function () {
            return view('auth.register');
        });

        //Fortify のユーザー登録処理を CreateNewUser に委託
        Fortify::createUsersUsing(CreateNewUser::class);

        //ログイン後のリダイレクト先を変更
        Fortify::redirects('login', '/weight_logs.index');

        //ユーザー登録後に `/register/step2` にリダイレクト
        Fortify::redirects('register', '/register/step2');

        //Fortify のログイン認証をカスタマイズ（バリデーションを適用）
        Fortify::authenticateUsing(function (Request $request) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ], [
                'email.required' => 'メールアドレスを入力してください',
                'email.email' => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
                'password.required' => 'パスワードを入力してください',
            ]);

            // 認証処理（メールアドレス & パスワードが正しいかチェック）
            if (Auth::attempt($credentials)) {
                return Auth::user(); // 認証成功
            }

            return null; // 認証失敗
        });
    }
}
