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
    public function payment()
    {
        return view('user.payment');
    }
    public function pricing()
    {
        return view('user.pricing');
    }
    public function explore()
    {
        return view('user.explore');
    }
    public function trending()
    {
        return view('user.trending');
    }
    public function result()
    {
        return view('user.result');
    }
    public function editProfile()
    {
        return view('user.edit-profile');
    }
}
