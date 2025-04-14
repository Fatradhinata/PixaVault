<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Report;
use App\Models\Content;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ServiceProvider;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); 
    }
    
    public function content(Request $req)
    {
        $q = $req->query('q');

        $content = Content::with('user')
            ->when($q, function ($query, $q) {
                return $query->orderByRaw('id = ? DESC', [$q]);
            })->get();
            

        return view('admin.content', [
            'content' => $content,
        ]);
    }

    public function leaderboard()
    {
        $startDate = Carbon::now()->startOfMonth()->toDateTimeString();
        $endDate = Carbon::now()->endOfMonth()->toDateTimeString();
        
        $leaderboardLike = ServiceProvider::getLeaderboardData($startDate, $endDate, 'likes');
        $leaderboardDownloads = ServiceProvider::getLeaderboardData($startDate, $endDate, 'downloads');

        return view('admin.leaderboard', [
            'leaderboardLike' => $leaderboardLike,
            'leaderboardDownloads' => $leaderboardDownloads,
        ]);
    }

    public function subscription(Request $req)
    {
        $q = $req->query('q');

        $subscription = Subscription::with('user')
            ->when($q, function ($query, $q) {
                return $query->orderByRaw('id = ? DESC', [$q]);
            })
            ->get();

        return view('admin.subscription', [
            'subscription' => $subscription,
        ]); 
    }

    public function payment()
    {
        $payment = Payment::with('subscription')->orderBy('created_at', 'desc')->get();
        
        return view('admin.payment', [
            'payment' => $payment,
        ]); 
    }

    public function users(Request $req)
    {
        $q = $req->query('q');

        $users = User::when($q, function ($query, $q) {
                return $query->orderByRaw('id = ? DESC', [$q]);
            })->orderByRaw("FIELD(role, 'admin', 'user')")->get();
        
        return view('admin.users', [
            'users' => $users,
        ]); 
    }

    public function report()
    {
        $report = Report::orderByRaw("FIELD(status, 'pending') DESC")->orderBy('created_at', 'desc')->get();
        
        return view('admin.report', [
            'report' => $report,
        ]); 
    }
}
