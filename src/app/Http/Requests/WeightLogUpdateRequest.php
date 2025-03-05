<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WeightLogUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date',
            'weight' => 'required|numeric|min:1|max:300',
            'calories' => 'nullable|integer|min:0',
            'exercise_time' => 'nullable|date_format:H:i',
            'exercise_content' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください。',
            'weight.required' => '体重を入力してください。',
            'weight.numeric' => '体重は数値で入力してください。',
            'weight.min' => '体重は1kg以上を入力してください。',
            'weight.max' => '体重は300kg以下を入力してください。',
            'calories.integer' => '摂取カロリーは整数で入力してください。',
            'calories.min' => '摂取カロリーは0以上を入力してください。',
            'exercise_time.date_format' => '運動時間は「hh:mm」形式で入力してください。',
            'exercise_content.string' => '運動内容は文字列で入力してください。',
            'exercise_content.max' => '運動内容は255文字以内で入力してください。',
        ];
    }
}
