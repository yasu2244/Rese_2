<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
        'time',
        'user_num',
        'user_id',
        'shop_id',
        'qr_code',
        'is_visited',
        'visited_at'
    ];
    

    // 予約の作成（テスト用に `total_amount` も計算）
    public static function postReservation($request, $shop_id)
    {
        return self::create([
            "date" => $request->date,
            "time" => $request->time,
            "user_num" => $request->user_num,
            "user_id" => auth()->id(),
            "shop_id" => $shop_id,
            "qr_code" => Str::uuid(), 
        ]);
    }

    // ショップ情報とのリレーション
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // ユーザー情報とのリレーション
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // 支払い情報とのリレーション（1予約:1支払い）
    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    protected $casts = [
        'date' => 'date',
        'time' => 'datetime:H:i',
    ];
}
