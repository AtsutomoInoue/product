<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Holidays extends FormRequest
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
            'day' => 'required|date_format:Y-m-d',
            'description' => 'required|max:15',
        ];
    }

    public function messages()
    {
        return[
            'day.required' => '日付を入力してください。',
            'day.date_format' => '日付はYYYY-MM-DDで入力してください。例：2020-01-01',
            'description.required' => '説明文を入力てください。',
            'description.max' => '15字以内に記入してください。'
        ];
    }
}
