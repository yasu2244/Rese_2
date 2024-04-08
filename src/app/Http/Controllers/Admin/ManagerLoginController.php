<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\Manager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerLoginController extends Controller
{
    public function getLogin()
    {
        return view('admin.manager_login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('manager')->attempt($credentials)) {
            return redirect()->route('manager.dashboard');
        } else {
            return redirect()->route('admin.login')->with('error', 'メールアドレスまたはパスワードが間違っています')->withInput($request->only('email'));
        }
    }
}
