<?php

namespace App\Http\Controllers;

use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ServiceProvider extends Controller
{
    public static function subscriptionCheck($userId)
    {
        if (!Auth::check()) return False;

        $subscription = Subscription::where('user_id', $userId)
            ->where('status', 'active')
            ->whereRaw("NOW() < date_limit")->first()
            ->orderBy('created_at', 'desc');

        if (!$subscription) return False;

        return $subscription;
    }
}
