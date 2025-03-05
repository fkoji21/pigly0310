<?php

namespace App\Http\Controllers;

use App\Models\WeightTarget;
use App\Http\Requests\WeightTargetRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WeightTargetController extends Controller
{
    // 初期体重登録フォームを表示
    public function showForm()
    {
        return view('auth.register_step2');
    }

    // 初期体重を登録
    public function store(WeightTargetRequest $request)
    {
        // すでに登録済みかチェック（1ユーザー1件のみ）
        if (WeightTarget::where('user_id', Auth::id())->exists()) {
            return redirect('/weight_logs')->with('error', 'すでに初期体重を登録済みです。');
        }

        try {
            // 初期体重を登録
            WeightTarget::create([
                'user_id' => Auth::id(),
                'target_weight' => $request->target_weight,
            ]);

            Log::info('初期体重登録完了', ['user_id' => Auth::id(), 'target_weight' => $request->target_weight]);

            return redirect('/weight_logs')->with('success', '初期体重が登録されました。');
        } catch (\Exception $e) {
            Log::error('初期体重登録エラー', ['error' => $e->getMessage()]);

            return redirect('/register/step2')->with('error', '初期体重の登録に失敗しました。もう一度お試しください。');
        }
    }

    public function edit()
    {
        $user = Auth::user();
        $weightTarget = WeightTarget::where('user_id', $user->id)->first();

        return view('weight_logs.goal_setting', compact('weightTarget'));
    }

    public function update(WeightTargetRequest $request)
    {
        $user = Auth::user();
        $weightTarget = WeightTarget::updateOrCreate(
            ['user_id' => $user->id],
            ['target_weight' => $request->target_weight]
        );

        return redirect()->route('weight_logs.index')->with('success', '目標体重を更新しました！');
    }
}
