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
            'target_weight' => ['required', 'numeric', 'between:1,999.9'],
        ];
    }

    public function messages()
    {
        return [
            'target_weight.required' => '目標体重を入力してください',
            'target_weight.numeric' => '目標体重は数字で入力してください',
            'target_weight.between' => '目標体重は1.0〜999.9kgの範囲で入力してください',
        ];
    }
}
