<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TokenController extends Controller
{
    /**
     * Activate a token and extend the user's subscription based on the token's action.
     *
     * This method is responsible for handling the activation of a token that the user receives through email.
     * The token may either extend the user's subscription by 1 month or 1 year, depending on the token's associated action. 
     * The method performs several checks to ensure the token is valid and that the user is authorized to use it:
     * - Checks if the token has already been used.
     * - Verifies that the token belongs to the currently authenticated user.
     * - Ensures that the subscription is found and the action (extend by 1 month or 1 year) is valid.
     * 
     * If everything is correct, the subscription is updated with the new expiration date, and the token is marked as used. 
     * Appropriate success or error messages are returned based on the outcome of the process.
     *
     * @param  \App\Models\Token  $id  The token object to be activated.
     * @return \Illuminate\Http\RedirectResponse
     */
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
