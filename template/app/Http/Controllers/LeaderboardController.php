<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index() {
        return view('user.leaderboard', [
            'data' => [],
        ]);
    }
}
