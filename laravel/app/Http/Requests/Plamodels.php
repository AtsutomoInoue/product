<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Plamodels extends FormRequest
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
             'name' => 'required',
             'price' => 'nullable|numeric',
             'released' => 'nullable|digits:6|numeric',
         ];
     }
     public function messages()
     {
         return[
           'name.required' => '名前を入力してください。',
           'price.numeric' => '価格は半角数字のみ入れてください。',
           'released.numeric' => '発売年月は数字のみ入れてください。',
           'released.digits' => '発売年月は6桁で入れてください。',
         ];
     }
}
