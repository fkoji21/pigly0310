<?php
namespace App\Actions\Fortify;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateUser
{
/**
 * Fortify のカスタムログイン処理
 */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        return Auth::attempt($credentials) ? Auth::user() : null;
    }
}
