<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeightLog;
use Illuminate\Support\Facades\Auth;

class WeightLogController extends Controller
{
    public function index()
    {
        // 現在ログイン中のユーザーの体重記録を取得しビューに渡す
        $weightLogs = WeightLog::where('user_id', Auth::id())->orderBy('date', 'desc')->get();
        return view('weight_logs.index', compact('weightLogs'));
    }

    public function create()
    {
        return view('weight_logs.create');
    }

    // 体重をデータベースに保存
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|min:1|max:300',
            'calories' => 'nullable|integer|min:0',
            'exercise_time' => 'nullable|date_format:H:i',
            'exercise_content' => 'nullable|string|max:255',
        ]);

        WeightLog::create([
            'user_id' => Auth::id(),
            'date' => $request->date,
            'weight' => $request->weight,
            'calories' => $request->calories,
            'exercise_time' => $request->exercise_time,
            'exercise_content' => $request->exercise_content,
        ]);

        return redirect()->route('weight_logs.create')->with('success', '体重を記録しました！');
    }

    // 体重編集フォームを表示
    public function edit($id)
    {
        $log = WeightLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        return view('weight_logs.edit', compact('log'));
    }

    // 体重データを更新
    public function update(Request $request, $id)
    {
        $request->validate([
            'date' => 'required|date',
            'weight' => 'required|numeric|min:1|max:300',
            'calories' => 'nullable|integer|min:0',
            'exercise_time' => 'nullable|date_format:H:i',
            'exercise_content' => 'nullable|string|max:255',
        ]);

        $log = WeightLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->update($request->all());

        return redirect()->route('weight_logs.create')->with('success', '体重データを更新しました！');
    }

    // 体重データを削除
    public function destroy($id)
    {
        $log = WeightLog::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $log->delete();

        return redirect()->route('weight_logs.create')->with('success', '体重データを削除しました。');
    }
}
