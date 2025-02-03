<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SendEmailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'subject.required' => '件名は必須です。',
            'subject.string' => '件名は文字列である必要があります。',
            'subject.max' => '件名は255文字以内で入力してください。',
            'message.required' => '本文は必須です。',
            'message.string' => '本文は文字列である必要があります。',
        ];
    }
}
