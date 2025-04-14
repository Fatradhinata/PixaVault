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
    /**
     * Display admin dashboard with statistics.
     *
     * Shows key metrics including:
     * - Total user count
     * - Active subscriptions count
     * - Total content count
     * - Pending reports count
     *
     * @return \Illuminate\View\View Returns dashboard view with statistics
     */
    public function index()
    {
        return view('admin.dashboard', [
            'users' => User::count(),
            'subscription' => Subscription::where('status', 'active')->count(),
            'content' => Content::count(),
            'report' => Report::where('status', 'pending')->count(),
        ]); 
    }
    
    /**
     * Display content management page with optional search filtering.
     *
     * Expected query parameters:
     * - q: string, optional — Search query for content filtering
     *
     * @param \Illuminate\Http\Request $req The incoming request
     * @return \Illuminate\View\View Returns content management view
     */
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

    /**
     * Display monthly leaderboard for likes and downloads.
     *
     * Shows two separate leaderboards:
     * - Top content by likes
     * - Top content by downloads
     * 
     * Data is filtered for current month only.
     *
     * @return \Illuminate\View\View Returns leaderboard view with rankings
     */
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

    /**
     * Display subscription management page with optional search filtering.
     *
     * Expected query parameters:
     * - q: string, optional — Search query for subscription filtering
     *
     * @param \Illuminate\Http\Request $req The incoming request
     * @return \Illuminate\View\View Returns subscription management view
     */
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

    /**
     * Display payment history page.
     *
     * Shows all payment records in reverse chronological order
     * with related subscription information.
     *
     * @return \Illuminate\View\View Returns payment history view
     */
    public function payment()
    {
        $payment = Payment::with('subscription')->orderBy('created_at', 'desc')->get();
        
        return view('admin.payment', [
            'payment' => $payment,
        ]); 
    }

    /**
     * Display user management page with optional search.
     *
     * Expected query parameters:
     * - q: string, optional — Search query for user search.
     *
     * @param \Illuminate\Http\Request $req The incoming request
     * @return \Illuminate\View\View Returns user management view
     */
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

    /**
     * Display report management page.
     *
     * Shows all reports sorted by:
     * 1. Pending status (highest priority)
     * 2. Creation date (newest first)
     *
     * @return \Illuminate\View\View Returns report management view
     */
    public function report()
    {
        $report = Report::orderByRaw("FIELD(status, 'pending') DESC")->orderBy('created_at', 'desc')->get();
        
        return view('admin.report', [
            'report' => $report,
        ]); 
    }
}
