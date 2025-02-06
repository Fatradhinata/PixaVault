<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();
        $user = User::where('email', $socialUser->email)->first();

        if ($user) {
            $auth = $user->update([
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);
        } else {
            $auth = User::create([
                'google_id' => $socialUser->id,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
                'full_name' => $socialUser->name,
                'name' => explode(' ',$socialUser->name)[0],
                'password' => bcrypt($socialUser->token),
                'email' => $socialUser->email,
                'verified_at' => date('Y-m-d H:i:s')
            ]);
        }

        Auth::login($auth);

        return redirect()->route('home')->with('success', 'Login successful!');
    }
}
