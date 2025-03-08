<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * 新規登録フォームの表示
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * 新規登録処理（STEP1）
     */
    public function postRegister(RegisterRequest $request)
    {
        // ユーザーを作成
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 自動ログイン
        Auth::login($user);

        // STEP2 へリダイレクト
        return redirect('/register/step2');
    }
}
