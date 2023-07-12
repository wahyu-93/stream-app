<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('admin.auth.auth');
    }

    public function authenticate(Request $request)
    {
        $this->validate($request,[
            'email' => 'required|email',
            'password'  => 'required'
        ]);

        $credentials = [
            'email' => $request->email,
            'password'  => $request->password
        ];
        $credentials['role'] = 'admin';

        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            return redirect()->route('movies.index');
        };
        
        return back()->withErrors([
            'error' => 'Wrong User or Password'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login.form');
    }
}
