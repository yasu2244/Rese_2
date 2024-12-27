<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store(RegisterRequest $request)
    {
        // 仮登録済みのメールアドレスをチェック
        $existingUser = User::where('email', $request->email)->first();
        if ($existingUser && is_null($existingUser->email_verified_at)) {
            return redirect()->back()->withErrors([
                'email' => 'このメールアドレスは既に仮登録されています。認証メールを確認してください。'
            ]);
        }

        // 仮登録済みのメールアドレスをチェック
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // セッションにユーザーIDを保存
        $request->session()->put('user_id', $user->id);

        // 認証メールを送信
        event(new Registered($user));

        // 認証待機画面にリダイレクト
        return redirect()->route('verification.notice');
    }

}
