<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $login = Auth::attempt([
            'username' => $request->post('username'),
            'password' => $request->post('password')
        ]);

        if ($login) {
            $request->session()->regenerate();

            return redirect()->intended('/dash');
        }

        return back()->with('error', 'Login failed!');

        // dd('berhasil login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
