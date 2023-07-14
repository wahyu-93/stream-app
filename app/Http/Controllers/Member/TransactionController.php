<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        $package = Package::find($request->transaction_id);

        $customer = Auth::user();

        $transaction = Transaction::create([
            'package_id'    => $package->id,
            'user_id'       => $customer->id,
            'amount'        => $package->price,
            'transaction_code'   => strtoupper(Str::random(10)),
            'status'        => 'pending'
        ]);

        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

        $params = array(
            'transaction_details'   => array(
                'order_id'  => $transaction->id,
                'gross_amount' => $transaction->amount
            ),
            'customer_details' => array(
                'first_name'    => $customer->name,
                'last_name'     => $customer->name,
                'email'         => $customer->email,
            )
        );

        $createMidtransTransaction = \Midtrans\Snap::createTransaction($params);
        $midtransRedirectUrl = $createMidtransTransaction->redirect_url;
        return redirect($midtransRedirectUrl);
    }
}
