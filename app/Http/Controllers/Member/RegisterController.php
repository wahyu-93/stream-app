<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class RegisterController extends Controller
{
    public function registerForm()
    {
        return view('member.register');
    }

    public function registerStore(Request $request)
    {
        $request->validate([
            'name'  => 'required',
            'email' => 'required|email',
            'phone_number' => 'required|numeric',
            'password'  => 'required'
        ]);

        $isExists = User::where('email', $request->email)->exists();
        if (!$isExists) {
            $data = $request->except('_token');
            $data['role'] = 'member';
            $data['password'] = Hash::make($request->password);

            User::create($data);
            // muncul halaman login
            return redirect()->route('login');
        };

        return back()->withErrors([
            'email' => 'Email Already Used'
        ]);
    }
}
