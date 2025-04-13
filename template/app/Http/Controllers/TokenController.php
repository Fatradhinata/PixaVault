<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    public function activateToken(Token $id)
    {
        try {
            if ($id->is_used) 
                return redirect()->route('home')->with('warning', 'Token alrealy been user!');
            if ($id->target !== Auth::id()) 
                return redirect()->route('home')->with('error', 'You are not authorized!');
    
            $subscription = ServiceProvider::subscriptionCheck($id->target);
            if (!$subscription) return redirect()->route('home')->with('error', 'Subscription not found!');
    
            if ($id->action == 'extends 1 year') {
                $subscription->update([
                    'date_limit' => Carbon::parse($subscription->date_limit)->addMonths(12),
                ]);
            } else if ($id->action == 'extends 1 month') {
                $subscription->update([
                    'date_limit' => Carbon::parse($subscription->date_limit)->addMonths(1),
                ]);
            } else {
                return redirect()->route('home')->with('error', 'Invalid action!');
            }

            $id->update([
                'is_used' => true
            ]);
    
            return redirect()->route('home')->with('success', 'Token activation success!');
        } catch (\Exception $e) {
            return redirect()->route('home')->with('error', 'Something went wrong! Please try again.');
        }
    }
}
