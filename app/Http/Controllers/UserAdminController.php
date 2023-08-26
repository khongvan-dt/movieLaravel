<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserAdminController extends Controller
{
    public function login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');

        $user = User::where('name', $username)->first();

        if ($user && $user->password === $password) {
            // Đăng nhập thành công

            if ($user->role === 'admin') {
                Auth::login($user);
                return redirect()->route('addCategory');
            } elseif ($user->role === 'customer') {
                Auth::login($user);
                return redirect()->route('index');
            }
        }
        return redirect()->route('login')->with('login_failed', true);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
