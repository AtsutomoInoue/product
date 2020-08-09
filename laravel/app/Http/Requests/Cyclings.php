<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Cyclings extends FormRequest
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
            'place' => 'required',
            'address' => 'required',
        ];
    }
    public function messages()
    {
      return [
        'place.required' => '場所を入力してください。',
        'address.required' => '住所を入力してください。',
      ];
    }
    public function attribute()
    {
      return[
        'place' => '場所',
        'address' => '住所',
        'comment' => 'コメント'
      ];
    }
}
