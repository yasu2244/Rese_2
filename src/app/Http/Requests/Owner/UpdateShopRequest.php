<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShopRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    

    public function rules()
    {   
        \Log::info('バリデーションチェックが実行されました');
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'area_id' => 'required|exists:areas,id',
            'genre_id' => 'required|exists:genres,id',
            'image' => 'nullable|file|image|mimes:jpeg,png|max:2048', // 画像は任意
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'name.max' => '店舗名は255文字以内で入力してください。',
            'description.required' => '説明は必須です。',
            'area_id.required' => '地域を選択してください。',
            'area_id.exists' => '選択した地域が無効です。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'genre_id.exists' => '選択したジャンルが無効です。',
            'image.image' => 'アップロード可能なファイル形式は画像のみです。',
            'image.mimes' => '画像形式はjpegまたはpngである必要があります。',
            'image.max' => '画像サイズは2MB以内である必要があります。',
        ];
    }

}
