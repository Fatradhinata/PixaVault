<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Payment;
use App\Models\Subscription;

class MidtransController extends Controller
{
    public function processPayment(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi
        $orderId = 'ORDER-' . uniqid();
        $grossAmount = 100000; 
        $transactionDetails = [
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
        ];

        // Data pelanggan
        $customerDetails = [
            'first_name'    => 'Budi',
            'email'         => 'budi@example.com',
            'phone'         => '08123456789',
        ];

        $returnUrl = route('payment.notification');
        
        // Parameter pembayaran
        $payload = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
            'return_url' => $returnUrl,
        ];

        // Generate Snap Token
        try {
            $snapToken = Snap::getSnapToken($payload);

            // Simpan ke database
            Payment::create([
                'id' => \Illuminate\Support\Str::uuid(),
                'user_id' => auth()->id(), 
                'order_id' => $orderId,
                'amount' => $grossAmount,
                'payment_type' => 'midtrans',
                'status' => 'pending',
                'transaction_id' => null,
                'midtrans_response' => null,
            ]);

            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    
    // public function handleNotification(Request $request)
    // {
    //     \Log::info('Payment Notification Received: ', $request->all());
    //     $serverKey = env('MIDTRANS_SERVER_KEY');
    //     $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

    //     if ($signatureKey != $request->signature_key) {
    //         return response()->json(['message' => 'Invalid signature'], 403);
    //     }

    //     $subscription = Subscription::where('order_id', $request->order_id)->first();

    //     if (!$subscription) {
    //         return response()->json(['message' => 'Order not found'], 404);
    //     }

    //     $user = $subscription->user;

    //     \Log::info('Transaction Status: ', ['status' => $request->transaction_status]);
    //     dd($request->all());

    //     if ($request->transaction_status == 'settlement') {
    //         $subscription->update(['status' => 'active']);
    //         $user->update(['free_limit' => -1]);
    //     } elseif ($request->transaction_status == 'expire' || $request->transaction_status == 'cancel') {
    //         $subscription->update(['status' => 'expired']);
    //         $user->update(['free_limit' => 15]);
    //     }

    //     return response()->json(['message' => 'Notification received']);
    // }
}
