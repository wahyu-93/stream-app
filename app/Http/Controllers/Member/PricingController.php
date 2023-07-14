<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PricingController extends Controller
{
    public function index()
    {
        $standart = Package::where('name', 'standart')->first();
        $gold = Package::where('name', 'gold')->first();

        return view('pricing', compact('standart', 'gold'));
    }
}
