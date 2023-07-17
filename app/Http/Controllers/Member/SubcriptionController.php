<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\UserPremium;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubcriptionController extends Controller
{
    public function index()
    {
        $user_premium = UserPremium::with('package')->where('user_id', Auth::user()->id)->first();
        return view('member.subcription', compact('user_premium'));
    }

    public function destroy($id)
    {
        UserPremium::find($id)->delete();
        return redirect()->route('member.dashboard');
    }
}
