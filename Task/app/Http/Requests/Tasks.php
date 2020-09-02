<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Tasks extends FormRequest
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
            'title' => 'required',
            'limit' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'title.required' => '題名を入れてください。',
            'limit.required' => '期限を入れてください。',
        ];
    }
}
