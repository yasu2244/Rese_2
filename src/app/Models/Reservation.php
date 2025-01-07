<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
    public static function postReservation($request, $shop_id)
    {
        $param = [
            "date" => $request->date,
            "time" => $request->time,
            "user_num" => $request->user_num,
            "user_id" => $request->user_id,
            "shop_id" => $shop_id,
        ];
        $reservation = Reservation::create($param);
        return $reservation;
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'date' => 'date',
    ];
}
