<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LoginRequest; 
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(LoginRequest $request)
    {
        // 認証に必要なデータを取得
        $credentials = $request->only('email', 'password');

        // 管理者用のガードを使って認証
        if (Auth::guard('admin')->attempt($credentials)) {
            return redirect()->intended('/admin');
        }

        // 認証失敗時のエラーメッセージを表示
        return back()->withErrors([
            'email' => '入力された情報が記録と一致しません。',
        ])->withInput($request->only('email'));
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
