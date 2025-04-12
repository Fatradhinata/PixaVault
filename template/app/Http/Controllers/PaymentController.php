<?php

namespace App\Http\Controllers;

use Exception;
use Carbon\Carbon;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Payment;
use Illuminate\Support\Str;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    public function index()
    {
        $payment = Payment::where('status', 'pending')->first();

        return view('user.pricing');
    }

    public function checkout($id, $snapToken)
    {
        if (!$id) return redirect()->back()->with('error', 'Data not found!');

        $data = Payment::with('subscription')
            ->where('id', $id)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->first();

        return view('user.checkout', [
            'payment' => $data,
            'snapToken' => $snapToken,
        ]);
    }

    public function purchase(int $type)
    {
        try {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;
            
            if (!in_array($type, [1, 2]))
                return redirect()->back()->with('error', 'Invalid type!');
    
            $user = Auth::user();
            $IDR = json_decode(file_get_contents('https://api.exchangerate-api.com/v4/latest/USD'), true)['rates']['IDR'];
            $amount = ($type == 1) ? intval(56 * $IDR) : intval(7 * $IDR);
            $orderId = strtoupper(Str::random(10));
    
            $subscription = Subscription::create([
                'user_id' => Auth::id(),
                'plans' => ($type == 1) ? 'Premium Pro' : 'Premium',
                'date_limit' => ($type == 1) ? now()->addMonth(12) : now()->addMonth(1),
            ]);
    
            $payment = Payment::create([
                'amount' => $amount,
                'order_id' => $orderId,
                'action' => 'purchase',
                'subscription_id' => $subscription->id,
            ]);
    
            $transactionDetails = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ]
            ];
    
            $snapToken = Snap::getSnapToken($transactionDetails);
    
            return redirect("/checkout/{$payment->id}/$snapToken");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function extends(int $type)
    {
        try {
            Config::$serverKey = env('MIDTRANS_SERVER_KEY');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            if (!in_array($type, [1, 2]))
            return redirect()->back()->with('error', 'Invalid type!');

            $user = Auth::user();
            $IDR = json_decode(file_get_contents('https://api.exchangerate-api.com/v4/latest/USD'), true)['rates']['IDR'] ?: 16000;
            $amount = ($type == 1) ? intval(56 * $IDR) : intval(7 * $IDR);
            $orderId = strtoupper(Str::random(10));

            $subscription = Subscription::where('user_id', $user->id)
                ->where('status', 'active')
                ->whereRaw('NOW() < date_limit')
                ->first();

            if (!$subscription) return redirect()->back()->with('error', 'Data not found!');

            $payment = Payment::create([
                'amount' => $amount,
                'order_id' => $orderId,
                'action' => ($type == 1) ? 'extends 1 year' : 'extends 1 month',
                'subscription_id' => $subscription->id,
            ]);
    
            $transactionDetails = [
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amount,
                ],
                'customer_details' => [
                    'first_name' => $user->name,
                    'email' => $user->email,
                ]
            ];
    
            $snapToken = Snap::getSnapToken($transactionDetails);
    
            return redirect("/checkout/{$payment->id}/$snapToken");

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function payment(string $orderId)
    {
        try {
            $payment = Payment::where('order_id', $orderId)
                ->where('status', 'pending')
                ->first();

            if (!$payment) return redirect()->back()->with('error', 'Data payment not found!');
            
            $payment->update(['status' => 'paid']);

            $action = $payment->action;
            $subscription = Subscription::where('id', $payment->subscription_id)->orderBy('created_at', 'desc')->first();

            if (!$subscription) return redirect()->back()->with('error', 'Data subscription not found!');


            if ($action == 'purchase') {

                $subscription->update(['status' => 'active']);
                return redirect()->route('subscription')->with('success', 'Subscription activated successfully!');

            } elseif (str_contains($action, 'extends')) {

                switch ($action) {
                    case "extends 1 month":
                        $months = 1;
                        break;
                    case "extends 1 year":
                        $months = 12;
                        break;
                    default:
                        return redirect()->back()->with('error', 'Invalid action!');
                }
                
                $subscription->update([
                    'date_limit' => Carbon::parse($subscription->date_limit)->addMonths($months),
                ]);

                return redirect()->route('subscription')->with('success', 'Subscription extended successfully!');
            }
        } catch (Exception $e) {
            return redirect()->back('')->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function cancelPayment(Payment $id)
    {
        try {
            $subscription = $id->with('subscription')->first()->subscription;
            
            if ($subscription->status == 'pending') {
                $subscription->delete();
            } else {
                $id->update(['status' => 'rejected']);
            }

            return redirect()->route('pricing')->with('success', 'Subscription canceled successfully!');
        } catch (\Exception $e) {
            return redirect()->route('pricing')->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function destroy(Request $req)
    {
        $id = Payment::find($req->input('id'));
        if (!$id) return redirect()->back()->with('error', 'Data not found!');

        try {
            if (Auth::user()->role == 'admin') {
                $id->delete();
                return redirect()->back()->with('success', 'Payment deleted successfully!');
            }
    
            return redirect()->back()->with('warning', 'You are not authorized to delete this content!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

}
