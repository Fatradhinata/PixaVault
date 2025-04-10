<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        return view('user.pricing');
    }

    public function paymentSuccess()
    {
        return view('user.profile');
    }

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

        Log::info('Payment Notification Received: ', $request->all());
        $serverKey = env('MIDTRANS_SERVER_KEY');
        $signatureKey = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        $subscription = Subscription::where('order_id', $request->order_id)->first();

        if (!$subscription) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        
        Log::info('Transaction Status: ', ['status' => $request->fraud_status == 'accept']);
        // dd($request->all());
        
        $user = $subscription->user;
        if ($request->fraud_status == "accept") {
            Log::info('asdsadsad Statasdasdus: ', ['status' => $request->fraud_status]);
            $subscription->update(['status' => 'active']);
            $user->update(['free_limit' => -1]);
            dd($request->all());
        } elseif ($request->fraud_status == 'expire' || $request->fraud_status == 'cancel') {
            $subscription->update(['status' => 'expired']);
            $user->update(['free_limit' => 15]);
        }

        return response()->json(['message' => 'Notification received']);
    }

    public function destroy(Request $req)
    {

        $id = Subscription::find($req->input('id'));
        if (!$id) return redirect()->back()->with('error', 'Data not found!');

        try {
            if (Auth::user()->role == 'admin') {
                $id->delete();
                return redirect()->back()->with('success', 'Subscription deleted successfully!');
            }
    
            return redirect()->back()->with('warning', 'You are not authorized to delete this content!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

}
