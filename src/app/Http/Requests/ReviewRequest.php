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
            'comment' => 'nullable|string|max:255',
            'restaurant_id' => Rule::unique('reviews')->where(function ($query) {
                return $query->where('user_id', auth()->id());
            })
        ];
    }

    public function messages()
    {
        return [
            'rating.required' => '評価は必須です。',
            'rating.integer' => '評価は整数で指定してください。',
            'rating.min' => '評価は1以上の値で指定してください。',
            'rating.max' => '評価は5以下の値で指定してください。',
            'comment.string' => 'コメントは文字列で指定してください。',
            'comment.max' => 'コメントは255文字以内で指定してください。',
            'restaurant_id.unique' => 'この飲食店にはすでにレビューを投稿しています。'
        ];
    }
}
