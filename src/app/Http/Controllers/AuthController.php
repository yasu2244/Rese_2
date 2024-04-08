<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function getRegister()
    {
        return view('register');
    }

    public function postRegister(RegisterRequest $request)
    {
        try {
            User::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

            return redirect()->route('thanks')->with('success', 'ユーザー登録が完了しました');
        } catch (\Throwable $th) {
            return redirect('register')->with('error', 'エラーが発生しました');
        }
    }

    public function getLogin()
    {
        return view('login');
    }

    public function postLogin(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 認証成功時の処理
            return redirect('/')->with('success', 'ログインに成功しました');
        } else {
            // 認証失敗時の処理
            return redirect()->back()->with('error', 'メールアドレスまたはパスワードが間違っています')->withInput($request->only('email'));
        }
    }

    public function getLogout()
    {
        Auth::logout();
        return redirect("login")->with('success', 'ログアウトしました');
    }
}
