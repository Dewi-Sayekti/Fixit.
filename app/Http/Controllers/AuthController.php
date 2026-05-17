<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ========== SHOW LOGIN ==========
    public function showLogin()
    {
        return view('login');
    }

    // ========== LOGIN PROCESS ==========
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
            'role'     => ['required'],
        ]);

        $user = User::where('username', $credentials['username'])
                    ->where('role', $credentials['role'])
                    ->first();

        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'error' => 'Username / password salah'
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');  // ← langsung ke jelajah
    }

    // ========== SIGNUP ==========
    public function showRegister()
{
    return view('login'); // kita tetap pakai halaman yg sama
}
    public function signup(Request $request)
    {
        $data = $request->validate([
            'username' => ['required', 'unique:users'],
            'password' => ['required', 'min:4'],
            'role'     => ['required', 'in:santri,staf']
        ]);

        $user = User::create([
            'username' => $data['username'],
            'password' => Hash::make($data['password']),
            'role'     => $data['role'],
        ]);

        Auth::login($user);

        return redirect()->route('dashboard');
    }

    

    // ========== LOGOUT ==========
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
