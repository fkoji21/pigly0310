<?php
namespace App\Http\Controllers;

use App\Http\Requests\WeightTargetRequest;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WeightTargetController extends Controller
{
    // 初期体重登録フォームを表示
    public function showForm()
    {
        return view('auth.register_step2');
    }

    // 体重を登録
    public function store(WeightTargetRequest $request)
    {
        $userId = Auth::id();

        // すでに登録済みかチェック（1ユーザー1件のみ）
        if (WeightTarget::where('user_id', $userId)->exists()) {
            return redirect('/weight_logs')->with('error', 'すでに目標体重を登録済みです。');
        }

        try {
            // 目標体重を登録
            WeightTarget::create([
                'user_id'       => $userId,
                'target_weight' => $request->target_weight,
            ]);

            // ✅ 初回の体重ログを `weight_logs` に登録する
            WeightLog::create([
                'user_id'          => $userId,
                'date'             => now()->toDateString(),    // 今日の日付
                'weight'           => $request->current_weight, // 「現在の体重」を保存
                'calories'         => 0,                        // 初期値
                'exercise_time'    => '00:00:00',               // 初期値
                'exercise_content' => '',                       // 初期値
            ]);

            return redirect('/weight_logs')->with('success', '体重が登録されました。');
        } catch (\Exception $e) {
            Log::error('体重登録エラー', ['error' => $e->getMessage()]);

            return redirect('/register/step2')->with('error', '体重の登録に失敗しました。');
        }
    }

    public function edit()
    {
        $user         = Auth::user();
        $weightTarget = WeightTarget::where('user_id', $user->id)->first();

        return view('weight_logs.goal_setting', compact('weightTarget'));
    }

    public function update(WeightTargetRequest $request)
    {
        $user         = Auth::user();
        $weightTarget = WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました！');
    }
}
