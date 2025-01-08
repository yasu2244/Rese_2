<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PaymentController extends Controller
{
    public function showPaymentForm()
    {
        return view('payment.form');
    }

    public function processPayment(Request $request)
    {
        // Stripeキーをセット
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            // 決済処理
            $charge = Charge::create([
                'amount' => $request->amount * 100, // 金額（単位はセント）
                'currency' => 'jpy',
                'source' => $request->stripeToken,
                'description' => 'Reseの支払い',
            ]);

            return back()->with('success', '決済が完了しました！');
        } catch (\Exception $e) {
            return back()->with('error', 'エラーが発生しました: ' . $e->getMessage());
        }
    }
}
