<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\Payment;
use Stripe\Stripe;
use Stripe\StripeClient;
use Stripe\Checkout\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Log;

class PaymentsController extends Controller
{
    // 未払いの予約一覧ページ
    public function index()
    {
        $user = auth()->user();

        $unpaidReservations = Reservation::where('user_id', $user->id)
            ->whereDoesntHave('payment', function ($query) {
                $query->where('status', 'succeeded');
            })
            ->with('payment')
            ->get();

        return view('payments.list', compact('unpaidReservations'));
    }

    // 予約情報の取得（支払い情報と一緒に取得）
    private function getReservation($reservationId)
    {
        $reservation = Reservation::where('id', $reservationId)
            ->where('user_id', auth()->id())
            ->with('payment')
            ->firstOrFail();

        if (!$reservation->payment) {
            throw new \Exception('支払い情報が見つかりません。');
        }

        if ($reservation->payment->status === 'succeeded') {
            throw new \Exception('この予約はすでに支払い済みです。');
        }

        return $reservation;
    }

    // クレジットカード決済用の支払いセッション作成
    public function createSession(Request $request)
    {
        try {
            Stripe::setApiKey(config('services.stripe.secret'));

            $reservation = $this->getReservation($request->reservation_id);
            $payment = $reservation->payment;

            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'jpy',
                        'product_data' => ['name' => 'Reservation Payment #' . $reservation->id],
                        'unit_amount' => $payment->amount,
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('payment.success', ['reservation_id' => $reservation->id]),
                'cancel_url' => route('payment.cancel'),
            ]);

            $payment->update([
                'stripe_payment_id' => $session->id,
                'method' => 'credit_card',
            ]);

            return response()->json(['id' => $session->id]);
        } catch (\Exception $e) {
            Log::error('クレジットカード決済エラー:', ['message' => $e->getMessage()]);
            return response()->json(['error' => '支払いセッションの作成に失敗しました。'], 400);
        }
    }

    // QRコード決済ページの表示
    public function showQr($reservationId)
    {
        try {
            $reservation = $this->getReservation($reservationId);
            $payment = $reservation->payment;
    
            if (!$payment->amount) {
                Log::error('QRコードエラー: 支払い金額が設定されていません。');
                return redirect()->route('payment.list')->withErrors(['QRコード決済エラー: 支払い金額が設定されていません。']);
            }
    
            if (!$payment->qr_code_url) {
                $stripe = new StripeClient(config('services.stripe.secret'));
    
                $paymentLink = $stripe->paymentLinks->create([
                    'line_items' => [[
                        'price' => 'price_1Qo6JcI8GAn4Ujr7nEHp6GV0',
                        'quantity' => 1,
                    ]],
                ]);
    
                $payment->update(['qr_code_url' => $paymentLink->url]);
            }
    
            $qrCode = QrCode::size(250)->generate($payment->qr_code_url);
    
            return view('payments.qr-payment', [
                'qr_code' => $qrCode,
                'reservationId' => $reservationId,
            ]);
        } catch (\Exception $e) {
            Log::error('QRコード表示エラー:', ['message' => $e->getMessage()]);
            return redirect()->route('payment.list')->withErrors(['QRコードの生成に失敗しました。']);
        }
    }
    

    // 支払い方法の変更
    public function updatePaymentMethod(Request $request)
    {
        try {
            Log::info('支払い方法更新リクエスト:', $request->all());

            if (!$request->has('reservation_id') || !$request->has('method')) {
                return response()->json(['error' => 'リクエストデータが不足しています。'], 400);
            }

            $payment = Payment::where('reservation_id', $request->reservation_id)->first();

            if (!$payment) {
                return response()->json(['error' => '支払い情報が見つかりません。'], 404);
            }

            if ($payment->status === 'succeeded') {
                return response()->json(['error' => '支払い方法は変更できません。'], 400);
            }

            $payment->update(['method' => $request->method]);

            return response()->json(['message' => '支払い方法が更新されました。']);
        } catch (\Exception $e) {
            Log::error('支払い方法更新エラー:', ['message' => $e->getMessage()]);
            return response()->json(['error' => '支払い方法の更新に失敗しました。'], 500);
        }
    }

    // 支払い成功時の処理
    public function success(Request $request)
    {
        try {
            // `stripe_payment_id` を元に支払い情報を取得
            $payment = Payment::where('stripe_payment_id', $request->session_id)->firstOrFail();
    
            // **支払い完了処理**
            $payment->update(['status' => 'succeeded']);
    
            // **関連する予約情報を取得**
            $reservation = $payment->reservation; // `Payment` モデルが `Reservation` に紐づいている前提
    
            return view('payments.success', compact('payment', 'reservation'));
        } catch (\Exception $e) {
            return redirect()->route('payment.list')->withErrors(['支払い処理に失敗しました。']);
        }
    }
    
    // 支払い状況の確認
    public function checkPaymentStatus($reservationId)
    {
        $payment = Payment::where('reservation_id', $reservationId)->first();

        if (!$payment) {
            return response()->json(['error' => '支払い情報が見つかりません。'], 404);
        }

        return response()->json(['status' => $payment->status]);
    }

    public function cancel()
    {
        $user = auth()->user();

        // 未払いの予約を取得
        $unpaidReservations = Reservation::where('user_id', $user->id)
            ->whereDoesntHave('payment', function ($query) {
                $query->where('status', 'succeeded');
            })
            ->with('payment')
            ->get();

        return view('payments.list', compact('unpaidReservations'));
    }
}
