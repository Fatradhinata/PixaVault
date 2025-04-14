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
    /**
     * Display pricing/subscription page.
     * 
     * This method checks if the authenticated user has an active subscription.
     * If an active subscription exists (not expired and status is 'active'),
     * it redirects to the subscription page with a warning message.
     * Otherwise, it shows the pricing page for new subscriptions.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * Returns either:
     * - Redirect to subscription page if active subscription exists
     * - Pricing view if no active subscription
     */
    public function index()
    {
        $subscription = Subscription::where('user_id', Auth::id())
            ->where('status', 'active')
            ->whereRaw("NOW() < date_limit")
            ->orderBy('created_at', 'desc')->first();

        if ($subscription) return redirect()->route('subscription')->with('warning', 'You already have an active subscription!');

        return view('user.pricing');
    }

    /**
     * Display checkout page for payment.
     *
     * This method shows the checkout page for a pending payment.
     * It verifies the payment exists and is in pending status before
     * displaying the checkout form with the provided Snap token.
     *
     * @param  string  $id  The payment ID to checkout
     * @param  string  $snapToken  The Snap token for payment processing
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * Returns either:
     * - Redirect back with error if payment not found
     * - Checkout view with payment data and Snap token
     */
    public function checkout(string $id, string $snapToken)
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

    /**
     * Process new subscription purchase.
     *
     * This method handles the creation of a new subscription and payment transaction.
     * It converts USD pricing to IDR using exchange rates, generates a unique order ID,
     * creates subscription and payment records, and initiates the Midtrans payment process.
     * 
     * Expected behavior:
     * - Validates subscription type (must be 1 or 2)
     * - Creates new subscription with appropriate plan and duration
     * - Creates payment record with converted IDR amount
     * - Generates Midtrans payment token
     * - Redirects to checkout page with payment details
     * 
     * @param int $type The subscription type (1 = "Premium Pro" annual, 2 = "Premium" monthly)
     * @return \Illuminate\Http\RedirectResponse Redirects to checkout page or back with error
     */
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

    /**
     * Extend existing active subscription.
     *
     * This method handles extending an existing active subscription by creating
     * a new payment transaction. It follows similar flow to purchase() but verifies
     * an active subscription exists before proceeding.
     *
     * @param int $type The extension type (1 = 1 year, 2 = 1 month)
     * @return \Illuminate\Http\RedirectResponse Redirects to checkout page or back with error
     * 
     * @throws \Exception On any processing error (caught internally)
     * 
     * Expected behavior:
     * - Validates extension type (must be 1 or 2)
     * - Verifies active subscription exists
     * - Creates payment record with appropriate action description
     * - Generates Midtrans payment token
     * - Redirects to checkout page with payment details
     */
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

    /**
     * Process successful payment and activate/extend subscription.
     *
     * This method handles successful payment confirmation by updating payment status
     * and either activating a new subscription or extending an existing one based
     * on the payment action. It supports both new purchases and extensions.
     *
     * @param string $orderId The unique order ID from payment gateway
     * @return \Illuminate\Http\RedirectResponse Redirects with status message
     * 
     * @throws \Exception On processing errors (caught internally)
     * 
     * Expected behavior:
     * - Verifies pending payment exists
     * - Updates payment status to 'paid'
     * - For 'purchase' action: activates new subscription
     * - For 'extends' action: extends subscription duration (1 month or 1 year)
     * - Handles invalid actions gracefully
     */
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

    /**
     * Cancel a pending payment and or subscription.
     *
     * This method handles cancellation of pending payments. For pending subscriptions,
     * it deletes the subscription record. For other cases, it marks the payment as rejected.
     *
     * @param \App\Models\Payment $id The payment model instance to cancel
     * @return \Illuminate\Http\RedirectResponse Redirects to home with status message
     * 
     * @throws \Exception On processing errors (caught internally)
     * 
     * Note:
     * - Different handling for pending subscriptions vs other payments
     * - Always redirects to home route after processing
     */
    public function cancelPayment(Payment $id)
    {
        try {
            $subscription = $id->with('subscription')->first()->subscription;
            
            if ($subscription->status == 'pending') {
                $subscription->delete();
            } else {
                $id->update(['status' => 'rejected']);
            }

            return redirect()->route('home')->with('success', 'Subscription canceled successfully!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Delete a payment record (admin only).
     *
     * This method allows administrators to permanently delete payment records.
     * It verifies the user has admin role before processing the deletion.
     *
     * Expected request data:
     * - id: string, required — The payment ID to delete
     *
     * @param \Illuminate\Http\Request $req The incoming request containing payment ID
     * @return \Illuminate\Http\RedirectResponse Redirects back with status message
     */
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
