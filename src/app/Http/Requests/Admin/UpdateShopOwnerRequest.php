<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopOwnerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        // 現在編集しているユーザーのIDを取得
        $shopOwnerId = $this->route('id');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $shopOwnerId,
            'shops' => 'nullable|array', // 複数選択可能な店舗ID
            'shops.*' => 'exists:shops,id', // 各IDがshopsテーブルに存在するか確認
        ];
    }


    public function messages()
    {
        return [
            'name.required' => '名前は必須です。',
            'name.max' => '名前は255文字以内で入力してください。',
            'email.required' => 'メールアドレスは必須です。',
            'email.email' => '正しいメールアドレス形式で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'shops.array' => '店舗情報が正しくありません。',
            'shops.*.exists' => '選択された店舗が存在しません。',
        ];
    }
}
