<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Http\Requests\ReservationRequest;

class ReservationsController extends Controller
{
    
    public function create(ReservationRequest $request)
    {
        try {
            // **予約データを作成**
            $reservation = Reservation::create([
                'date' => $request['date'],
                'time' => $request['time'],
                'user_num' => $request['user_num'],
                'user_id' => Auth::id(),
                'shop_id' => $request['shop_id'],
                'qr_code' => Str::uuid(), 
            ]);
    
            // **仮の支払いデータを作成**
            Payment::create([
                'reservation_id' => $reservation->id,
                'amount' => $reservation->user_num * 1000, // 1人あたり1000円
                'status' => 'pending', // 未払い
                'method' => 'credit_card', // ← デフォルト値
                'stripe_payment_id' => null,
                'qr_code_url' => null,
            ]);
    
            \Log::info('支払い情報を作成しました:', ['reservation_id' => $reservation->id]);
    
            return view('reservation-completion');
        } catch (\Throwable $th) {
            \Log::error('予約作成エラー:', ['error' => $th->getMessage()]);
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
        $reservation = Reservation::findOrFail($reservation_id);

        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        $reservation->update([
            'date' => $request->input('date'),
            'time' => $request->input('time'),
            'user_num' => $request->input('user_num'),
            'qr_code' => Str::uuid(),
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

    public function showQr($reservation_id)
    {
        $reservation = Reservation::findOrFail($reservation_id);

        if ($reservation->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        if (is_null($reservation->qr_code)) {
            throw new \Exception('QRコードの値が存在しません。');
        }

        return view('qr', [
            'reservation' => $reservation,
            'qr_code' => QrCode::size(200)->generate($reservation->qr_code),
        ]);
    }

    public function verifyQrCode(Request $request)
    {
        $reservation = Reservation::where('qr_code', $request->qr_code)->first();

        if ($reservation) {
            $reservation->update([
                'is_visited' => true,
                'visited_at' => now(),
            ]);

            return response()->json([
                'status' => 'success',
                'reservation' => $reservation,
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => '予約が見つかりません。',
        ], 404);
    }

}
