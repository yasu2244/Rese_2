<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'stripe_payment_id',
        'amount',
        'status',
        'method',  
        'qr_code_url', 
    ];

    // 予約とのリレーション
    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    // (仮)支払い金額を取得
    public function getTotalAmountAttribute()
    {
        return $this->user_num * 1000; // 1人あたり1000円
    }
}
