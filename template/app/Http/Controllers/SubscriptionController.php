<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{

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

    public function getDataById($id)
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

    public function update(Request $req)
    {
        $validated = $req->validate([
            'id' => 'required|string',
            'plans' => 'required|in:Premium,Premium Pro',
            'status' => 'required|in:pending,active',
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
