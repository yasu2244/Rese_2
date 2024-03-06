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
