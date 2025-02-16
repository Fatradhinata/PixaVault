<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Transaction;
use App\Models\Payment;

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

        // Parameter pembayaran
        $payload = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        // Generate Snap Token
        try {
            $snapToken = Snap::getSnapToken($payload);

            // Simpan ke database
            Payment::create([
                'id' => \Illuminate\Support\Str::uuid(),
                'user_id' => auth()->id(), // Sesuai user login
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

    public function handleNotification(Request $request)
    {
        $serverKey = config('midtrans.server_key');
        $input = file_get_contents("php://input");
        $notification = json_decode($input, true);

        // Verifikasi Signature Key Midtrans
        $signatureKey = hash('sha512', $notification['order_id'] . $notification['status_code'] . $notification['gross_amount'] . $serverKey);
        if ($signatureKey !== $notification['signature_key']) {
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Update pembayaran di database
        $payment = Payment::where('order_id', $notification['order_id'])->first();
        if ($payment) {
            $payment->update([
                'status' => $notification['transaction_status'],
                'transaction_id' => $notification['transaction_id'],
                'midtrans_response' => $notification,
            ]);
        }

        return response()->json(['message' => 'Payment notification received']);
    }
}
