<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $movies = Movie::orderBy('featured', 'ASC')->orderBy('created_at', 'ASC')->get();
        return view('member.dashboard', compact('movies'));
    }
}
