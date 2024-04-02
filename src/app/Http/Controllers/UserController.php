<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Favorite;
use App\Models\Reservation;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $favoriteRestaurants = $user->favorites()->with('restaurant')->get();
        $userName = $user->name;
        $reservations = Reservation::where('user_id', $user->id)->with('restaurant')->get();

        $reservations->each(function ($reservation) {
            $reservation->formatted_time = \Carbon\Carbon::parse($reservation->reservation_time)->format('H:i');
        });

        return view('mypage', compact('favoriteRestaurants', 'userName', 'reservations'));
    }

    //reservationへ移す?
    public function deleteReservation(Request $request)
    {
        $reservationId = $request->input('reservation_id');

        try {
            $reservation = Reservation::findOrFail($reservationId);

            $reservation->delete();

            return response()->json(['success' => true, 'message' => '予約を削除しました']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => '予約の削除に失敗しました']);
        }
    }
}