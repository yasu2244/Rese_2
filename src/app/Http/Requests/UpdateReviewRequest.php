<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // 編集時に認可のチェックが必要であれば、ここで設定します
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
            'comment' => 'nullable|string|max:255',
            'images.*' => 'nullable|image|mimes:jpeg,png|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rating.required' => '評価は必須です。',
            'comment.string' => 'コメントは文字列で指定してください。',
            'comment.max' => 'コメントは255文字以内で指定してください。',
            'images.*.image' => 'アップロードするファイルは画像でなければなりません。',
            'images.*.mimes' => 'アップロードできる画像の形式はjpegまたはpngのみです。',
            'images.*.max' => '画像ファイルのサイズは2MB以下でなければなりません。',
        ];
    }
}
