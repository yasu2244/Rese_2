<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

       if (Auth::guard('admin')->attempt($credentials)) {
        $user = Auth::guard('admin')->user();
        if ($user->isAdmin()) {
            return redirect()->route('admin.shop-list')->with('success', '管理者としてログインしました。');
        } else {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->withInput($request->only('email'))->with('error', '管理者権限がありません。');
        }
    } else {
        return redirect()->route('admin.login')->withInput($request->only('email'))->with('error', 'メールアドレスまたはパスワードが間違っています');
    }
    }
}