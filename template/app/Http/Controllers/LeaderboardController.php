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
    public function index() 
    {
        $startDate = Carbon::now()->startOfMonth()->toDateTimeString();
        $endDate = Carbon::now()->endOfMonth()->toDateTimeString();

        $leaderboardLikes = ServiceProvider::getLeaderboardData($startDate, $endDate, 'likes');
        $leaderboardDownloads = ServiceProvider::getLeaderboardData($startDate, $endDate, 'downloads');

        return view('user.leaderboard', compact('leaderboardLikes', 'leaderboardDownloads'));
    }

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
