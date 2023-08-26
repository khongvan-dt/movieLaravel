<?php

namespace App\Http\Controllers;

use App\Models\UserAdmin;

use Illuminate\Http\Request;

class registerController extends Controller
{
    public function insert(Request $request)
    {
        $role = 'customer';

        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
        ]);

        // Sử dụng mass assignment để tạo đối tượng UserAdmin
        $register = UserAdmin::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'], 
            'role' => $role,
        ]);

        return redirect()->route('login')->with('r', true);
    }
}
