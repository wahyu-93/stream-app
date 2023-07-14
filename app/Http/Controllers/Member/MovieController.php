<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function showDetailMovie($id)
    {
        $movie = Movie::find($id);
        return view('member.detail-movie', compact('movie'));
    }
}
