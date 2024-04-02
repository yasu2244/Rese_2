<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Models\Reservation; 
use App\Http\Requests\ReservationRequest;

class ReservationController extends Controller
{
    //予約の登録
    public function confirmReservation(ReservationRequest $request)
    {
        $userId = auth()->id();
        $validatedData = $request->validated();
        $restaurantId = $validatedData['restaurant_id'];
        $restaurant = Restaurant::find($restaurantId);

        list($hour, $minute) = explode(':', $validatedData['reservation_time']);

        $reservation = new Reservation();
        $reservation->user_id = $userId;
        $reservation->restaurant_id = $restaurantId; 
        $reservation->reservation_date = $validatedData['reservation_date'];
        $reservation->reservation_time = $validatedData['reservation_time'];
        $reservation->reservation_number = $validatedData['reservation_number'];

        $reservation->save();
        $request->session()->put('reservation_done', true);
        return redirect()->route('reservation.done')->with('reservation_form_submitted', true);
    }

    public function showDonePage()
    {
        if (!session('reservation_form_submitted')) {
            return redirect()->route('shop.index');
        }

        return view('reservation.done');
    }

    public function reserve(Request $request)
    {
        // 直前のページのURLを取得
        $previousUrl = Session::get('previousUrl');

        return redirect()->to($previousUrl);
    }

    public function showChangeForm(Request $request ,$reservation_id)
    {
        // 予約情報を取得
        $reservation = Reservation::find($reservation_id);
        if (!$reservation) {
            return redirect()->back()->with('error', '指定された予約が見つかりませんでした。');
        }

        $restaurant = Restaurant::find($reservation->restaurant_id); 

        return view('reservation.change')->with('reservation', $reservation)->with('restaurant', $restaurant);
    }

    public function changeReservation(Request $request, $reservation_id)
    {
        // 予約情報を取得
        $reservation = Reservation::find($reservation_id);
        if (!$reservation) {
            return redirect()->route('mypage')->with('error', '指定された予約が見つかりませんでした。');
        }

        // 予約情報を更新する処理
        $reservation->update([
            'reservation_date' => $request->input('reservation_date'),
            'reservation_time' => $request->input('reservation_time'),
            'reservation_number' => $request->input('reservation_number'),
        ]);

        return redirect()->route('mypage')->with('success', '予約が変更されました。');
    }
}
