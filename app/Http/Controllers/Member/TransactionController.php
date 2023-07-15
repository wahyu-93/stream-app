<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Transaction;
use App\Models\User;
use App\Models\UserPremium;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // cari package dan data customer
        $package = Package::find($request->transaction_id);
        $customer = Auth::user();

        // simpan dalam table transaction
        $transaction = Transaction::create([
            'package_id' => $package->id,
            'user_id'    => $customer->id,
            'amount'     => $package->price,
            'transaction_code' => strtoupper(Str::random(10)),
            'status'     => 'pending'
        ]);

        // midtrans proses
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$isSanitized = env('MIDTRANS_IS_SANITIZED');
        \Midtrans\Config::$is3ds = env('MIDTRANS_IS_3DS');

        $params = array(
            'transaction_details' => array(
                'order_id'  => $transaction->transaction_code,
                'gross_amount'  => $transaction->amount,
            ),
            'customer_details' => array(
                'first_name'    => $customer->name,
                'last_name'     => $customer->name,
                'email'         => $customer->email
            ),
        );

        $createMidtransTransaction = \Midtrans\Snap::createTransaction($params);
        $redirectMidtransUrl = $createMidtransTransaction->redirect_url;
        return redirect($redirectMidtransUrl);
    }

    public function handlerAfterPayment()
    {
        \Midtrans\Config::$isProduction = env('MIDTRANS_IS_PRODUCTION');
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        $notif = new \Midtrans\Notification();

        $status = '';
        $transactionStatus = $notif->transaction_status;
        $transactionCode = $notif->order_id;
        $fraudStatus = $notif->fraud_status;

        if ($transactionStatus == 'capture') {
            if ($fraudStatus == 'challenge') {
                $status = 'challenge';
            } else if ($fraudStatus == 'accept') {
                $status = 'success';
            }
        } else if ($transactionStatus == 'settlement') {
            $status = 'success';
        } else if (
            $transactionStatus == 'cancel' ||
            $transactionStatus == 'deny' ||
            $transactionStatus == 'expire'
        ) {
            $status = 'failure';
        } else if ($transactionStatus == 'pending') {
            $status = 'pending';
        };

        // simpan transaksi ke userpremium
        $transaction = Transaction::with('package')->where('transaction_code', $transactionCode)->first();

        if ($status == 'success') {
            $userPremium = UserPremium::where('user_id', $transaction->user_id)->first();

            if ($userPremium) {
                $endOfSubscription = $userPremium->end_of_subcription;
                $date = Carbon::createFromFormat('Y-m-d', $endOfSubscription);
                $newOfSubscription = $date->addDays($transaction->package->max_days)->format('Y-m-d');

                $userPremium->update([
                    'package_id'    => $transaction->package->id,
                    'end_of_subcription' => $newOfSubscription,
                ]);
            } else {
                UserPremium::create([
                    'package_id'    => $transaction->package->id,
                    'user_id'       => $transaction->user_id,
                    'end_of_subcription' => now()->addDays($transaction->package->max_days),
                ]);
            };
        };

        $transaction->update(['status' => 'success']);
    }
}
