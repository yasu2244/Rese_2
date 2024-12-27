<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class CustomEmailVerificationRequest extends FormRequest
{
    public function authorize()
    {
        // リクエストの ID に基づいてユーザーを取得
        $user = User::find($this->route('id'));

        if (!$user) {
            return false; // ユーザーが見つからない場合は認可を拒否
        }

        // リクエストにユーザーを保存
        $this->merge(['user' => $user]);

        return true;
    }

    public function rules()
    {
        return [];
    }

    public function user($guard = null)
    {
        // リクエストに保存されたユーザーを返す
        return $this->get('user');
    }
}
