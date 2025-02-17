<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        return view('user.profile', [
            'user' => Auth::user()
        ]);
    }

    public function details(User $id) {
        return view('user.profile', [
            'user' => $id,
            'contents' => $id->contents
        ]); 
    }
    
    public function editProfile(User $id)
    {
        return view('user.edit-profile', data: [
            'user' => $id,
        ]);
    }
}
