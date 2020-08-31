<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Comments extends FormRequest
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
          'name' => 'required|max:30',
          'body'=> 'required|max:2000',
      ];
    }

    public function messages()
    {
        return[
            'name.required' => '名前を入力してください。',
            'name.max' => '名前が長すぎます。',
            'body.required' => '本文を入力しください。',
            'body.max' => '本文は2000字以内で入力してください。',
        ];
    }
}
