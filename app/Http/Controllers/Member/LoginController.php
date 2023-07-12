<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginForm()
    {
        return view('member.login');
    }

    public function auth(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password'  => 'required'
        ]);

        $data = $request->only('email', 'password');
        $data['role'] = 'member';

        if (Auth::attempt($data)) {
            $request->session()->regenerate();
            return 'sukses';
        }

        return back()->withErrors([
            'errors' => 'wrong password'
        ]);
    }
}
