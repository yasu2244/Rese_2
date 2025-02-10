<?php

namespace App\Http\Requests\Owner;

use Illuminate\Foundation\Http\FormRequest;

class StoreShopRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:20',
            'area_id' => 'required|integer|exists:areas,id',
            'genre_id' => 'required|integer|exists:genres,id',
            'description' => 'required|string|max:400',
            'image' => 'required|image|mimes:jpeg,png|max:2048', // JPEGまたはPNG形式のみ、最大2MB
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '店舗名は必須です。',
            'name.max' => '店舗名は20文字以内で入力してください。',
            'area_id.required' => '地域を選択してください。',
            'genre_id.required' => 'ジャンルを選択してください。',
            'description.required' => '店舗概要を入力してください。',
            'description.max' => '店舗概要は400文字以内で入力してください。',
            'image.required' => '画像をアップロードしてください。',
            'image.image' => 'アップロード可能な形式はjpegまたはpngのみです。',
            'image.mimes' => '画像形式はjpegまたはpngである必要があります。',
            'image.max' => '画像サイズは2MB以内である必要があります。',
        ];
    }
}
