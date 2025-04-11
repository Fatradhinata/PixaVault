<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Content;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); 
    }
    public function content()
    {
        $content = Content::with('user')->get();

        return view('admin.content', [
            'content' => $content,
        ]);
    }
    public function subscription()
    {
        $subscription = Subscription::select('*',
            DB::raw('
                PERIOD_DIFF(EXTRACT(YEAR_MONTH FROM date_limit), EXTRACT(YEAR_MONTH FROM created_at)) AS month_diff,
                (NOW() < date_limit) AS ex_status'
            ))->with('user')->get();
        
        return view('admin.subscription', [
            'subscription' => $subscription,
        ]); 
    }
    public function users()
    {
        $users = User::orderByRaw("FIELD(role, 'admin', 'user')")->get();
        
        return view('admin.users', [
            'users' => $users,
        ]); 
    }
}
