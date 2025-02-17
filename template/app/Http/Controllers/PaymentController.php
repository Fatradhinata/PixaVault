<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function createTransaction(Request $request)
    {
        // Debugging server key
        if (!env('MIDTRANS_SERVER_KEY')) {
            throw new \Exception("MIDTRANS_SERVER_KEY is not set in .env");
        }

        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Buat ID pesanan unik
        $orderId = strtoupper(Str::random(10));

        // Simpan ke database
        $subscription = Subscription::create([
            'id' => Str::uuid(),
            'user_id' => Auth::id(),
            'order_id' => $orderId,
            'amount' => $request->amount,
            'payment_type' => 'midtrans',
            'status' => 'pending',
            'date_limit' => now()->addMonth(),
        ]);

        // Buat data transaksi ke Midtrans
        $transactionDetails = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $request->amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name ?? 'Guest',
                'email' => Auth::user()->email ?? 'guest@example.com',
            ]
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($transactionDetails);

        return response()->json(['snap_token' => $snapToken]);

    }



    public function handleNotification(Request $request)
    {
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($signatureKey != $request->signature_key) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        $subscription = Subscription::where('order_id', $request->order_id)->first();

        if (!$subscription) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $user = $subscription->user; 

        if ($request->transaction_status == 'settlement') {
            $subscription->update(['status' => 'active']);
            $user->update(['free_limit' => -1]);
        } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
            $subscription->update(['status' => 'expired']);
            $user->update(['free_limit' => 15]);
        }

        return response()->json(['message' => 'Notification received']);
    }

}
