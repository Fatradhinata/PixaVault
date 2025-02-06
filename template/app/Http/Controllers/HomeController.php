<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        return view('user.home');
    }
    public function content()
    {
        return view('user.content');
    }
    public function blog()
    {
        return view('user.blog');
    }
    public function leaderboard()
    {
        return view('user.leaderboard');
    }
    public function favorites()
    {
        return view('user.favorites');
    }
    public function history_download()
    {
        return view('user.history_download');
    }
}
