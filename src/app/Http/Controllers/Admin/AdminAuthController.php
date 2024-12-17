<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login'); // ログインフォームを表示
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $role = Auth::user()->role->name ?? null;
        
            if (!$role) {
                Auth::logout();
                return back()->withErrors(['message' => 'ユーザーの権限が設定されていません']);
            }
        
            switch ($role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'shop_owner':
                    return redirect()->route('shop.dashboard');
                default:
                    Auth::logout();
                    return back()->withErrors(['message' => '権限がありません']);
            }
        }        

        // 認証失敗
        return back()->withErrors(['message' => 'ログインに失敗しました']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login');
    }
}
