<?php
namespace App\Http\Controllers;

use App\Http\Requests\WeightTargetRequest;
use App\Models\WeightTarget;
use Illuminate\Support\Facades\Auth;

class WeightTargetController extends Controller
{
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
