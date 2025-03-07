<?php
namespace App\Providers;

use App\Actions\Fortify\AuthenticateUser;
use App\Actions\Fortify\CreateNewUser;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider; // 追加
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // ログインの試行回数制限
        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(10)->by($request->ip());
        });

        // Fortify のビュー指定
        Fortify::loginView(fn() => view('auth.login'));
        Fortify::registerView(fn() => view('auth.register'));

        // ユーザー登録処理を CreateNewUser に委託
        Fortify::createUsersUsing(CreateNewUser::class);

        // 認証処理を AuthenticateUser に委託
        Fortify::authenticateUsing([AuthenticateUser::class, 'authenticate']);
    }
}
