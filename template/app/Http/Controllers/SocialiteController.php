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

        $user = User::updateOrCreate([
            'google_id' => $socialUser->id,
        ], [
            'google_token' => $socialUser->token,
            'google_refresh_token' => $socialUser->refreshToken,
            'name' => explode(' ',$socialUser->name)[0],
            'email' => $socialUser->email,
            'password' => bcrypt($socialUser->token),
            'role' => 'user',
            'verified_at' => date('Y-m-d H:i:s')
        ]);

        Auth::login($user);

        return redirect()->route('home');
    }
}
