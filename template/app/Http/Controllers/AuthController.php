<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\SendVerificationLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }

    public function register() {
        return view('auth.register');
    }

    public function getDataById($id)
    {
        $data = User::find($id);

        return response()->json(($data) ? [
            'status' => 'success',
            'data' => $data,
        ] : [
            'status' => 'fail',
            'message' => 'Data is not found/empty',
        ]);
    }

    public function processLogin(Request $req) {
        $credential = $req->validate([
            'email' => 'required|email|max:50',
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
            'email' => 'required|max:50|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'name' => $credential['name'],
            'email' => $credential['email'],
            'password' => bcrypt($credential['password']),
        ]);

        try {
            Mail::to($user->email)->send(new SendVerificationLink([ 
                "user_id" => $user->id,
                "username" => $user->name,
            ]));
        } catch (Exception $e) {}

        return redirect()->route('login')->with('success', "Registration Successful! <br>We send you a verification email. Please check your inbox.");
    }


    public function needToVerify() {
        if (Auth::user()->verified_at) return redirect()->route('home');
        
        return view('auth.verify');
    }

    public function sendEmailVerification(Request $req) {
        $user = $req->user();

        if (!$user->verified_at) {
            try {
                Mail::to($user->email)->send(new SendVerificationLink([ 
                    "user_id" => $user->id,
                    "username" => $user->name,
                ]));
            } catch (Exception $e) {
                return redirect()->route('home')->with('warning', "Something wrong when sending email. Please try again");
            }
    
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

    public function logout(Request $req) {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerate();
        return redirect()->route('login')->with('success', "Logout successful!");
    }

    public function update(Request $req)
    {
        foreach (['full_name', 'phone_number'] as $field)
            if ($req->has($field) && $req->input($field) === null) $req->merge([$field => '']);

        $validated = $req->validate([
            'id' => 'required|string',
            'name' => 'required|string|max:20',
            'full_name' => 'nullable|string|max:100',
            'role' => 'required|string|in:admin,user',
            'email' => 'required|email',
            'phone_number' => 'nullable|string',
            'free_limit' => 'required|integer',
            'verified_at' => 'nullable|date'
        ]);

        try {
            $data = User::find($validated['id']);
            if (!$data) return redirect()->back()->with('error', 'Data not found!');
    
            $data->update($validated);
            return redirect()->back()->with('success', 'Data updated successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }

    public function destroy(Request $req) {
        $id = User::find($req->input('id'));
        if (!$id) return redirect()->back()->with('error', 'Data not found!');

        try {
            if (Auth::user()->role == 'admin') {
                Storage::delete('profile_photos/' . $id->profile_photo);
                
                $id->delete();
                return redirect()->back()->with('success', 'User deleted successfully!');
            }
    
            return redirect()->back()->with('warning', 'You are not authorized to delete this content!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong! Please try again.');
        }
    }
}
