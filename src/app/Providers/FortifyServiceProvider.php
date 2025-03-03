<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Fortify;
use Illuminate\Support\ServiceProvider;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // 🔹 Fortify のログイン画面を指定（ビューがないとエラーになる）
        Fortify::loginView(function () {
            return view('auth.login'); // `resources/views/auth/login.blade.php` を指定
        });

        // 🔹 Fortify のログイン認証をカスタマイズ（バリデーションを適用）
        Fortify::authenticateUsing(function (Request $request) {
            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            // 🔹 認証処理（メールアドレス & パスワードが正しいかチェック）
            if (Auth::attempt($credentials)) {
                return Auth::user(); // ✅ 認証成功
            }

            return null; // ❌ 認証失敗
        });
    }
}
