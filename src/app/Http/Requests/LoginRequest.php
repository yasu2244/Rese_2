<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;  

class LoginRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'string', 'max:191'],
            'password' => ['required', 'string', 'min:8', 'max:191'],
        ];
    }

    public function messages()
    {
        return [
        'email.required' => 'メールアドレスを入力してください。',
        'email.string' => 'メールアドレスを文字列で入力してください・',
        'email.max' => 'メールアドレスを191文字以内で入力してください',
        'password.required' => 'パスワードを入力してください',
        'password.string' => 'パスワードを文字列で入力してください',
        'password.min' => '8文字以上で入力してください',
        'password.max' => '191文字以内で入力してください',
        ];
    }

    public function authenticate()
    {
        $credentials = $this->only('email', 'password');

        if (!Auth::attempt($credentials)) {
            throw ValidationException::withMessages([
                'email' => [trans('auth.failed')],
            ]);
        }

        return true; 
    }
}
