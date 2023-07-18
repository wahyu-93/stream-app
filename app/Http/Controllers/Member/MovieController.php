<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\UserPremium;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MovieController extends Controller
{
    public function showDetailMovie($id)
    {
        $movie = Movie::find($id);
        return view('member.detail-movie', compact('movie'));
    }

    public function watch($id)
    {
        $user = Auth::user();
        $user_premium = UserPremium::where('user_id', $user->id)->first();

        // cek tanggal subcsription, jika melebihi tnggal sekarang lempar ke pricing page
        $endSubcription = $user_premium->end_of_subcription;
        $cekEndSubcription = Carbon::createFromFormat('Y-m-d',$endSubcription);
        $isValid = $cekEndSubcription->greaterThan(now());
        
        if($isValid){
            $movie = Movie::where('id', $id)->first();
            return view('member.watching',compact('movie'));
        }

        return redirect()->route('pricing');
    }
}
