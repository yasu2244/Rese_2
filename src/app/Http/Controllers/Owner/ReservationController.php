<?php

namespace App\Http\Controllers\Owner;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // 予約状況一覧を表示
    public function listReserve()
    {
        $reservations = Reservation::whereHas('shop', function ($query) {
            $query->where('owner_id', auth()->id()); // ログイン中の店舗代表者が担当する店舗
        })->with(['shop', 'user'])->get();

        return view('owner.reservations-list', compact('reservations'));
    }
}
