<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Posts extends FormRequest
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
            'title' => 'required|max:50',
            'name' => 'required|max:30',
            'body'=> 'required|max:2000',
        ];
    }

    public function messages()
    {
        return[
            'title.required' => '題名を入力してください。',
            'title.max' => '題名は50字以内で入力してください。',
            'name.required' => '名前を入力してください。',
            'name.max' => '名前が長すぎます。',
            'body.required' => '本文を入力しください。',
            'body.max' => '本文は2000字以内で入力してください。',
        ];
    }
}
