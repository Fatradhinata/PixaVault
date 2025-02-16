<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile');
    }

    public function details(User $id) {
        return view('user.profile', [
            'user' => $id
        ]); 
    }
}
