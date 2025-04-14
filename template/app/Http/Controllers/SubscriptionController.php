<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    /**
     * Display the user's active subscription.
     *
     * This method checks whether the authenticated user has an active subscription.
     * If a valid subscription is found, it calculates the difference in months and days
     * from the current date, and determines whether the subscription is still active.
     * If no active subscription is found, the user is redirected to the pricing page.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function index()
    {
        $subscription = Subscription::select('*', DB::raw(
            'PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM date_limit), EXTRACT(YEAR_MONTH FROM created_at)) AS month_diff,
            DATEDIFF(date_limit, NOW()) AS day_diff,
            (NOW() < date_limit) AS ex_status'
        ))
        ->where('user_id', Auth::id())
        ->where('status', 'active')
        ->whereRaw('(NOW() < date_limit)')
        ->orderBy('created_at', 'desc')
        ->first();

        if (!$subscription) return redirect()->route('pricing')->with('warning', "You don't have an active subscription!");

        return view('user.subscription', [
            'subscription' => $subscription,
        ]);
    }

    /**
     * Get the subscription data by ID.
     *
     * This method fetches a subscription based on the provided ID and returns the data
     * as a JSON response. If the subscription is not found, it returns a failure message.
     *
     * @param  string  $id  The ID of the subscription.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDataById(string $id)
    {
        $data = Subscription::find($id);

        return response()->json(($data) ? [
            'status' => 'success',
            'data' => $data,
        ] : [
            'status' => 'fail',
            'message' => 'Data is not found/empty',
        ]);
    }

    /**
     * Update the subscription details.
     *
     * This method updates the subscription's data, including the plan, status, and expiration date.
     * It validates the input data and performs the update. If successful, the user is redirected back
     * with a success message; otherwise, an error message is returned.
     * 
     * Expected request data:
     * - id: required, string — the unique identifier of the subscription to be updated.
     * - plans: required, enum — the subscription plan. Can be 'Premium' or 'Premium Pro'.
     * - status: required, enum — the subscription status. Can be 'pending', 'active', or 'expired'.
     * - date_limit: required, date — the expiration date of the subscription.
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing the subscription data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $req)
    {
        $validated = $req->validate([
            'id' => 'required|string',
            'plans' => 'required|in:Premium,Premium Pro',
            'status' => 'required|in:pending,active,expired',
            'date_limit' => 'required|date',
        ]);

        try {
            $data = Subscription::find($validated['id']);
            if (!$data) return redirect()->back()->with('error', 'Data not found!');
    
            $data->update($validated);
            return redirect()->back()->with('success', 'Data updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    /**
     * Delete a subscription.
     *
     * This method deletes a subscription based on the provided ID. Only users with an "admin" role
     * are authorized to delete a subscription. If the deletion is successful, a success message is
     * returned. Otherwise, a warning message is shown for non-admin users.
     * 
     * Expected request data:
     * - id: string, required — the UUID of the user to delete.
     *
     * @param  \Illuminate\Http\Request  $req  The incoming request containing the subscription ID to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
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
