<?php
namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\RegisterStep2Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{
    /**
     * ユーザー登録フォーム（STEP1）の表示
     */
    public function register()
    {
        return view('auth.register');
    }

    /**
     * ユーザー登録処理（STEP1）
     */
    public function postRegister(RegisterRequest $request)
    {
        // ユーザー作成
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // 自動ログイン
        Auth::login($user);

        // STEP2 へリダイレクト
        return redirect()->route('register.step2');
    }

    /**
     * 体重データ入力画面（STEP2）の表示
     */
    public function showStep2()
    {
        return view('auth.register_step2');
    }

    /**
     * 体重データ登録処理（STEP2）
     */
    public function storeStep2(RegisterStep2Request $request)
    {
        $userId = Auth::id();

        try {
            // 目標体重を登録
            WeightTarget::create([
                'user_id'       => $userId,
                'target_weight' => $request->target_weight,
            ]);

            // 初回の体重ログを `weight_logs` に登録する
            WeightLog::create([
                'user_id'          => $userId,
                'date'             => now()->toDateString(),    // 今日の日付
                'weight'           => $request->current_weight, // 「現在の体重」を保存
                'calories'         => 0,                        // 初期値
                'exercise_time'    => '00:00:00',               // 初期値
                'exercise_content' => '',                       // 初期値
            ]);

            return redirect()->route('weight_logs.index')->with('success', '目標体重と初回体重が登録されました！');
        } catch (\Exception $e) {
            Log::error('体重登録エラー', ['error' => $e->getMessage()]);

            return redirect()->route('register.step2')->with('error', '登録に失敗しました。');
        }
    }
}
