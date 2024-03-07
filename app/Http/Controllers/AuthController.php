<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\RedirectResponse;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ])->Validate();

        User::create([
            'username' => $request->username,
            'roles' => 'user',
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Berhasil mendaftar');
    }

    public function registerAdmin(Request $request)
    {
        Validator::make($request->all(), [
            'username' => 'required',
            'name' => 'required',
            'address' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ])->Validate();

        User::create([
            'username' => $request->username,
            'roles' => 'admin',
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', 'Berhasil mendaftar');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function loginAction(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')->with('success', 'Berhasil masuk');
        }
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil keluar');
    }
}
