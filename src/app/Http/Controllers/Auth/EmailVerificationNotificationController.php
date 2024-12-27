<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // セッションからユーザー情報を取得
        $userId = $request->session()->get('user_id');

        if (!$userId) {
            return redirect()->route('register')->withErrors([
                'error' => 'セッションが無効です。再度登録してください。',
            ]);
        }

        // ユーザーをデータベースから取得
        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('register')->withErrors([
                'error' => '該当するユーザーが見つかりません。再度登録してください。',
            ]);
        }

        // 既に認証済みの場合
        if ($user->hasVerifiedEmail()) {
            return redirect()->route('thanks')->with('status', '既に認証済みです。');
        }

        try {
            // 認証メールを再送信
            $user->sendEmailVerificationNotification();
        } catch (\Exception $e) {
            // 再送信失敗時のエラー処理
            return back()->withErrors([
                'error' => 'メールの再送信に失敗しました。時間をおいて再度お試しください。',
            ]);
        }

        return back()->with('status', '認証メールを再送信しました。');
    }
}
