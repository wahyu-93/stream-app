<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['package', 'user'])->get();
        return view('admin.transaction.index', compact('transactions'));
    }
}
