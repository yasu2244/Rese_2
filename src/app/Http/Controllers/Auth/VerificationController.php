<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Verified;
use App\Http\Requests\CustomEmailVerificationRequest;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    // 認証待ち画面を表示（未ログインでも動作）
    public function show(Request $request)
    {
        // 未ログイン状態で認証待ち画面を表示する
        return view('auth.verify-email');
    }

    // 認証リンクを処理
    public function __invoke(CustomEmailVerificationRequest $request)
    {
        $user = $request->user();
    
        if (!hash_equals((string) $request->route('hash'), sha1($user->getEmailForVerification()))) {
            return abort(403, '無効な認証リンクです。');
        }
    
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('thanks')->with('status', '既に認証済みです。');
        }
    
        $user->markEmailAsVerified();
        event(new Verified($user));
    
        return redirect()->route('thanks')->with('success', 'メール認証が完了しました！');
    }
}
