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

    public function rules()
    {
        return [
        'date' => 'required|date',
        'weight' => [
            'required',
            'numeric',
            'between:1,999.9',
            'regex:/^\d{1,4}(\.\d)?$/',
        ],
        'calories' => 'required|integer|min:0',
        'exercise_time' => 'required|date_format:H:i',
        'exercise_content' => 'nullable|string|max:120',
        ];
    }

    public function messages()
    {
        return [
        'date.required' => '日付を入力してください。',
        'weight.required' => '体重を入力してください。',
        'weight.numeric' => '数字で入力してください。',
        'weight.between' => '4桁までの数字で入力してください。',
        'weight.regex' => '小数点は1桁で入力してください。',
        'calories.required' => '摂取カロリーを入力してください。',
        'calories.integer' => '数字で入力してください。',
        'exercise_time.required' => '運動時間を入力してください。',
        'exercise_time.date_format' => '運動時間は「hh:mm」形式で入力してください。',
        'exercise_content.max' => '120文字以内で入力してください。',
        ];
    }
}
