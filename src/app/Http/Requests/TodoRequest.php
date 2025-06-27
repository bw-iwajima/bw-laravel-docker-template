<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //ここがfalseだとすべてのリクエストを受け付けてしまう
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|max:255', //バリデーションのルール指定　required=入力が必要。max:255 最大文字数
        ];
    }

    public function messages()
    {
        return[

            'content.required' => 'ToDoが入力されていません。',
            'content.max'=> 'ToDoは :max 文字以内で入力してください。'

        ];

    }
}
