<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ReviewRequest extends FormRequest
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
            'rating' => 'required',
            'comment' => 'nullable|string|max:400',
            'images.*' => 'nullable|image|mimes:jpeg,png|max:2048',
            'shop_id' => Rule::unique('reviews')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価の指定は必須です。',
            'comment.string' => '文字列で指定してください。',
            'comment.max' => '400文字以内で入力してください。',
            'images.*.image' => 'アップロードするファイルは画像でなければなりません。',
            'images.*.mimes' => 'アップロードできる画像の形式はjpegまたはpngのみです。',
            'images.*.max' => '画像ファイルのサイズは2MB以下でなければなりません。',
            'shop_id.unique' => '※この飲食店にはすでにレビューを投稿しています。'
        ];
    }
}
