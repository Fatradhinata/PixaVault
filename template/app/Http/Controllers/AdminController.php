<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard'); 
    }
    public function content()
    {
        return view('admin.content'); 
    }
    public function subscription()
    {
        return view('admin.subscription'); 
    }
    public function user()
    {
        return view('admin.user-admin'); 
    }
}
