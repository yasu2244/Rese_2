<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ReservationRequest;

class ReservationsController extends Controller
{
    public function create(ReservationRequest $request)
    {
        try {
            Reservation::create([
                'date' => $request['date'],
                'time' => $request['time'],
                'user_num' => $request['user_num'],
                'user_id' => Auth::id(),
                'shop_id' => $request['shop_id']
            ]);
            return view('reservation-completion');
        } catch (\Throwable $th) {
            return redirect('detail/' . $request['shop_id']);
        }
    }

    public function edit($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $timeSlots = [
            '10:00', '10:30', '11:00', '11:30', '12:00',
            '12:30', '13:00', '13:30', '14:00', '14:30',
            '17:00', '17:30', '18:00', '18:30', '19:00',
            '19:30', '20:00', '20:30', '21:00', '21:30', '22:00',
        ];

        return view('reservation-edit', compact('reservation', 'timeSlots'));
    }


    public function update(ReservationRequest $request, $reservation_id)
    {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required',
            'user_num' => 'required|integer|min:1|max:10',
        ]);

        $reservation = Reservation::findOrFail($reservation_id);

        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'user_num' => $request->input('user_num'),
        ]);

        return redirect()->route('mypage')->with('fs_msg', '予約内容を更新しました');
    }

    public function destroy($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->delete();

        return redirect()->route('mypage')->with('fs_msg', '予約を削除しました');
    }

}
