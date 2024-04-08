<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminRegisterRequest extends FormRequest
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:admins,email|string|max:191',
            'password' => 'required|string|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
        'name.required' => '名前を入力してください。',
        'name.string' => '名前を文字列で入力してください。',
        'name.max' => '名前を191文字以内で入力してください。',
        'email.required' => 'メールアドレスを入力してください。',
        'email.unique' => 'このメールアドレスは既に使用されています。',
        'email.string' => 'メールアドレスを文字列で入力してください・',
        'email.max' => 'メールアドレスを191文字以内で入力してください',
        'password.required' => 'パスワードを入力してください',
        'password.string' => 'パスワードを文字列で入力してください',
        'password.min' => '8文字以上で入力してください',
        'password.max' => '191文字以内で入力してください',
        ];
    }
}
