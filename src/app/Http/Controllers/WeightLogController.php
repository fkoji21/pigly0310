<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\WeightLogRequest;
use App\Http\Requests\WeightLogUpdateRequest;

class WeightLogController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user(); // ログインユーザーを取得
        $query = WeightLog::where('user_id', $user->id);

        // 検索条件の適用
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        if ($request->filled('start_date')) {
            $query->whereDate('date', '>=', $startDate);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('date', '<=', $endDate);
        }

        $weightLogs = $query->orderBy('date', 'desc')->paginate(8); // ページネーション
        $resultCount = $weightLogs->total(); // 検索結果の件数

        // 最新の体重データを取得（ログがない場合は null）
        $latestWeight = WeightLog::where('user_id', $user->id)
            ->orderBy('date', 'desc')
            ->value('weight');

        // 目標体重を取得（weight_target テーブルから取得）
        $targetWeight = WeightTarget::where('user_id', $user->id)
            ->value('target_weight');

        return view('weight_logs.index', compact('weightLogs', 'latestWeight', 'targetWeight', 'startDate', 'endDate', 'resultCount'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    // 体重をデータベースに保存
    public function store(WeightLogRequest $request)
    {
        WeightLog::create([
            'user_id' => Auth::id(), // ログイン中のユーザーIDを追加
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.index')->with('success', '体重を記録しました！');
    }

    // 体重編集フォームを表示
    public function edit($id)
    {
        $log = WeightLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('weight_logs.edit', compact('log'));
    }

    // 体重データを更新
    public function update(WeightLogUpdateRequest $request, $id)
    {

        $log = WeightLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->update($request->validated());

        return redirect()->route('weight_logs.index')->with('success', '体重データを更新しました！');
    }

    // 体重データを削除
    public function destroy($id)
    {
        $log = WeightLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->delete();

        return redirect()->route('weight_logs.index')->with('success', '体重データを削除しました。');
    }
}
