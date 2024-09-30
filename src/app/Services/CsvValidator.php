<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class CsvValidator
{
    public function validateRow(array $row, int $index)
    {
        // 行ごとのバリデーションルールを定義
        $validator = Validator::make($row, [
            '店舗名' => 'required|max:50',
            '地域' => 'required|in:東京都,大阪府,福岡県',
            'ジャンル' => 'required|in:寿司,焼肉,イタリアン,居酒屋,ラーメン',
            '店舗概要' => 'required|max:400',
            '画像URL' => 'required|url|regex:/\.(jpeg|jpg|png)$/i',
        ], [
            '画像URL.regex' => '画像URLはjpegまたはpng形式である必要があります。',
        ]);

        // バリデーションに失敗した場合、エラーメッセージを返す
        if ($validator->fails()) {
            return "行 {$index + 1}: " . implode(", ", $validator->errors()->all());
        }

        // バリデーション成功
        return null;
    }
}
