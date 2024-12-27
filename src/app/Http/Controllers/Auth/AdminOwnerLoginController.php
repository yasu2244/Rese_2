<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOwnerLoginController extends Controller
{
    // ログインフォームを表示
    public function showLoginForm()
    {
        return view('auth.admin-owner-login'); //
    }

    // ロールに基づくリダイレクト処理を分離
    private function redirectBasedOnRole($role)
    {
        switch ($role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'shop_owner':
                return redirect()->route('owner.dashboard');
            default:
                return null;
        }
    }

    // ログインメソッド
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role->name ?? null;

            if (!$role) {
                Auth::logout();
                return back()->withErrors(['message' => 'ユーザーの権限が設定されていません。']);
            }

            $redirect = $this->redirectBasedOnRole($role);

            if ($redirect) {
                return $redirect;
            }

            Auth::logout();
            return back()->withErrors(['message' => '権限がありません。']);
        }

        return back()->withErrors(['message' => 'ログインに失敗しました。']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin-owner.login.form')->with('status', 'ログアウトしました');
    }
}
