<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\AdminLoginPostRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login', [
            "title" => "ورود یا ثبت نام",
            "rawLayout" => true,
            "authLayout" => true
        ]);
    }

    public function login(AdminLoginPostRequest $request)
    {
        $credentials = $request->validated();

        $admin = Admin::where('username', $credentials['username'])->first();

        if (!$admin || !Hash::check($credentials['password'], $admin->password)) {
            return back()->withErrors([
                'login' => '  نام کاربری یا رمز عبور اشتباه است.'
            ]);
        }

        Auth::guard('admin')->login($admin);
        return redirect()->route('admin.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.auth.login.form');
    }
}
