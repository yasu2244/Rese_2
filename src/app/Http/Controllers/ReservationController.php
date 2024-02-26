<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ReservationController extends Controller
{
    public function confirmReservation(Request $request)
    {
        // 予約の確認と保存などの処理を行う

        return redirect()->route('reservation.done');
    }

    public function showDonePage()
    {
        return view('reservation.done');
    }

    public function reserve(Request $request)
    {
        // 直前のページのURLを取得
        $previousUrl = Session::get('previousUrl');

        return redirect()->to($previousUrl);
    }
}
