<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Token;
use App\Mail\SendGift;
use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\ServiceProvider;

class LeaderboardController extends Controller
{
    /**
     * Display the leaderboard for the current month based on likes and downloads.
     *
     * This method retrieves the leaderboard data for the top users based on the number of likes and downloads
     * they received during the current month. It calls the `getLeaderboardData` method from the `ServiceProvider`
     * to get the relevant data based on likes and downloads. The data is then passed to the view for display.
     *
     * @return \Illuminate\View\View
     */
    public function index() 
    {
        $startDate = Carbon::now()->startOfMonth()->toDateTimeString();
        $endDate = Carbon::now()->endOfMonth()->toDateTimeString();

        $leaderboardLikes = ServiceProvider::getLeaderboardData($startDate, $endDate, 'likes');
        $leaderboardDownloads = ServiceProvider::getLeaderboardData($startDate, $endDate, 'downloads');

        return view('user.leaderboard', compact('leaderboardLikes', 'leaderboardDownloads'));
    }

    /**
     * Send a gift to a user with optional token extension.
     *
     * This method allows an admin to send a gift (achievement) to a user, including a badge and tier, and optionally
     * extend the user's subscription by issuing a token. It validates the input data, creates the achievement for the
     * user, and sends an email notification with the gift details. If the `with-token` option is provided, a token is 
     * created to extend the user's subscription (either for 1 month or 1 year). It handles errors gracefully and provides 
     * feedback to the admin.
     *
     * Expected request data:
     * - id: string, required — the UUID of the user to send the gift to.
     * - title: string, required — the title of the gift.
     * - tier: string, required — the tier of the gift (`mythic`, `gold`, `silver`, or `common`).
     * - badge: string, required — the URL of the badge image.
     * - with-token: string, optional — if provided, includes a token to extend the user's subscription.
     * - plans: string, optional — the subscription plan, determines the duration of the extension.
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing the gift details.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendGift(Request $req) 
    {
        $validated = $req->validate([
            'id' => "required|uuid|exists:users,id",
            'title' => "required|string|max:100",
            'tier' => "required|string|in:mythic,gold,silver,common",
            'badge' => "required|url",
            'with-token' => "nullable|in:on",
            'plans' => "string",
        ]);

        try {
            $user = User::where('id', $validated['id'])->first();
    
            Achievement::create([
                'user_id' => $validated['id'],
                'title' => $validated['title'],
                'tier' => $validated['tier'],
                'badge' => $validated['badge'],
            ]);
    
            if (isset($validated['with-token'])) {
                $token = Token::create([
                    'action' => ($validated['plans'] == "Premium Pro") ? 'extends 1 year' : 'extends 1 month',
                    'target' => $user->id,
                ]);
    
                $validated['token'] = $token->id;
            }
    
            Mail::to($user->email)->send(new SendGift([ 
                "username" => $user->name,
                "title" => $validated['title'],
                "token" => $validated['token'] ?? null,
            ]));
    
            return redirect()->back()->with('success', "Sending email to <b>{$user->email}</b>");
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
