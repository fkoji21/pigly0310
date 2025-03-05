<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightTargetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'target_weight' => [
                'required',         // 入力必須
                'numeric',          // 数値のみ
                'regex:/^\d{1,4}(\.\d{1})?$/', // 4桁以内 & 小数点1桁まで
            ],
        ];
    }

    public function messages()
    {
        return [
            'target_weight.required' => '目標体重を入力してください',
            'target_weight.numeric' => '4桁までの数字で入力してください',
            'target_weight.regex' => '4桁までの数字で、小数点は1桁で入力してください。',
        ];
    }
}
