<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function index()
    {
        return view('content.login.loginUser');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials) || Auth::attempt([
            'email' => $request->username,
            'password' => $request->password
        ])) {
            $request->session()->regenerate();

            if(Auth::user()->role == 'restoran'){

                return redirect()->intended('/halaman-resto')->with(['success' => ' Berhasil Login ']);
            }else {
                return redirect()->intended('/')->with(['success' => ' Berhasil Login ']);
                
            }
        }

        return back()->with('loginErorr', 'username atau password salah!!');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/')->with('logout', 'Berhasil Logout!!');
    }

    public function register()
    {
        return view('content.register');
    }
}
