<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopCsvRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|max:50',
            'area' => 'required|in:東京都,大阪府,福岡県',
            'genre' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
            'description' => 'required|max:400',
            'image' => 'required|image|mimes:jpeg,png|max:2048', 
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'name.max' => '店舗名は50文字以内で入力してください。',
            'area.required' => '地域は必須です。',
            'area.in' => '地域は「東京都」「大阪府」「福岡県」のいずれかを選択してください。',
            'genre.required' => 'ジャンルは必須です。',
            'genre.in' => 'ジャンルは「寿司」「焼肉」「イタリアン」「居酒屋」「ラーメン」のいずれかを選択してください。',
            'description.required' => '店舗概要は必須です。',
            'description.max' => '店舗概要は400文字以内で入力してください。',
            'image.required' => '画像は必須です。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像はjpegまたはpng形式である必要があります。',
            'image.max' => '画像ファイルは2MB以下でアップロードしてください。',
        ];
    }
}
