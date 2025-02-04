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
        return view('auth/login');
    }

    public function register() {
        return view('auth/register');
    }

    public function processLogin(Request $req) {
        $credential = $req->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        $attemp = Auth::attempt([
            'email' => $credential['email'],
            'password' => $credential['password'],
        ]);

        if ($attemp) {
            $req->session()->regenerate();
            return redirect()->intended()->with('success', "Login successful!");
        }

        return back()->with("warning", "Username or Password Wrong!");
    }

    public function processRegister(Request $req) {
        $credential = $req->validate([
            'name' =>'required|max:20',
            'email' => 'required|max:20|email:dns|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => bcrypt($credential['password']),
        ]);

        Mail::to($credential['email'])->send(new SendVerificationLink());

        return redirect()->route('login')->with('success', "Registration successful!");
    }

    public function sendEmailVerification(Request $req) {
        $email = $req->user()->email;
        Mail::to($email)->send(new SendVerificationLink());
        return redirect('/contact')->with('success', "Email sent successfully!");
    }

    public function verify(User $id) {
        $id->verified = true;
        $id->save();
        return redirect()->route('home')->with('success', "Email Verification successful!");
    }

    function logout(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerate();
        return redirect()->to('login')->with('success', "Logout successful!");
    }
}
