<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminRegisterRequest;
use App\Models\Admin;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        return view('admin.register');
    }

    public function register(AdminRegisterRequest $request)
    {
        $validatedData = $request->validated();

        try {
            $admin = Admin::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            return redirect()->route('admin.login')->with('success', '管理者として登録されました');
        } catch (\Throwable $th) {
            return redirect()->route('admin.register')->with('result', 'エラーが発生しました');
        }
    }
}