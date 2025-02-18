<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard'); 
    }
    public function content()
    {
        return view('admin.pages.content'); 
    }
    public function subscription()
    {
        return view('admin.pages.subscription'); 
    }
    public function user()
    {
        return view('admin.pages.user-admin'); 
    }
}
