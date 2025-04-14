<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirects the user to the Google OAuth provider for authentication.
     * 
     * This method initiates the OAuth flow by redirecting the user to Google's
     * authentication page where they can grant permissions to the application.
     * 
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handles the callback from Google OAuth provider after authentication.
     * 
     * This method processes the user information returned by Google OAuth provider.
     * It either:
     * - Updates an existing user with Google OAuth credentials if the email exists
     * - Creates a new user with Google OAuth credentials if the email doesn't exist
     * 
     * After successful authentication, the user is logged in and redirected:
     * - To the verification page if their email isn't verified
     * - To the home page if their email is verified
     * 
     * @return \Illuminate\Http\RedirectResponse
     */
    public function callback()
    {
        $socialUser = Socialite::driver('google')->user();
        $user = User::where('email', $socialUser->email)->first();

        if ($user) {
            $auth = $user->update([
                'google_id' => $socialUser->id,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
            ]);

            $auth = $user;
        } else {
            $auth = User::create([
                'google_id' => $socialUser->id,
                'google_token' => $socialUser->token,
                'google_refresh_token' => $socialUser->refreshToken,
                'full_name' => $socialUser->name,
                'name' => explode(' ', $socialUser->name)[0],
                'password' => bcrypt($socialUser->token),
                'email' => $socialUser->email,
                'verified_at' => date('Y-m-d H:i:s')
            ]);
        }

        Auth::login($auth);
        session()->save();


        if (!Auth::user()->verified_at)
            return redirect('/need-to-verify')->with('success', "Login Successful! Please verify your email first.");

        return redirect()->route('home')->with('success', 'Login successful!');
    }
}
