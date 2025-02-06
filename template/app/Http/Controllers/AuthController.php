<?php

namespace App\Http\Controllers;

use App\Mail\SendVerificationLink;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function processLogin(Request $req) {
        $credential = $req->validate([
            'email' => 'required|email:dns|max:50',
            'password' => 'required',
        ]);

        $attemp = Auth::attempt([
            'email' => $credential['email'],
            'password' => $credential['password'],
        ]);

        if ($attemp) {
            $req->session()->regenerate();

            if (!Auth::user()->verified_at) 
                return redirect('/need-to-verify')->with('success', "Login Successful! Please verify your email first.");

            return redirect()->route('home')->with('success', "Login Successful!");
        }

        return back()->with("warning", "Username or Password Wrong!");
    }

    public function processRegister(Request $req) {
        $credential = $req->validate([
            'name' =>'required|max:20',
            'email' => 'required|max:50|email:dns|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => bcrypt($credential['password']),
        ]);

        Mail::to($user->email)->send(new SendVerificationLink([ 
            "user_id" => $user->id,
            "username" => $user->name,
        ]));

        return redirect()->route('login')->with('success', "Registration Successful! <br>We send you a verification email. Please check your inbox.");
    }


    public function needToVerify() {
        if (Auth::user()->verified_at) return redirect()->route('home');
        
        return view('auth.verify');
    }

    public function sendEmailVerification(Request $req) {
        $user = $req->user();

        if (!$user->verified_at) {
            Mail::to($user->email)->send(new SendVerificationLink([ 
                "user_id" => $user->id,
                "username" => $user->name,
            ]));
    
            return redirect()->route('home')->with('success', "Email Sent Successfully! Please check your inbox.");
        }
        
        return redirect()->route('home')->with('warning', "Email already verified!");
    }

    public function verify(User $id) {
        if (!$id->verified_at) {
            $id->verified_at = date('Y-m-d H:i:s');
            $id->save();
    
            if (!Auth::check()) Auth::login($id);
            return redirect()->route('home')->with('success', "Email Verification Successful!");
        }
        abort(404);
    }

    function logout(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerate();
        return redirect()->route('login')->with('success', "Logout successful!");
    }
}
