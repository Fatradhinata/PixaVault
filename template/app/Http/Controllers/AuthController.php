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
    /**
     * Display the login page.
     *
     * This method shows the login form view for unauthenticated users.
     * 
     * @return \Illuminate\View\View Returns the login view
     */
    public function login() {
        return view('auth.login');
    }

    /**
     * Display the registration page.
     *
     * This method shows the registration form view for new users
     * to create an account.
     * 
     * @return \Illuminate\View\View Returns the registration view
     */
    public function register() {
        return view('auth.register');
    }

    /**
     * Display the email verification notice page.
     *
     * This method shows the verification notice view for authenticated
     * users who haven't verified their email address. Automatically
     * redirects to home if user is already verified.
     * 
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     * Returns either:
     * - Redirect to home if user is verified
     * - Verification notice view if user needs verification
     */
    public function needToVerify() {
        if (Auth::user()->verified_at) return redirect()->route('home');
        
        return view('auth.verify');
    }

    /**
     * Retrieve user data by ID.
     *
     * This method searches for a user record based on the provided ID.
     * If the user is found, it returns a JSON response with the user data.
     * Otherwise, it returns a JSON response indicating that the data was not found.
     *
     * @param  int  $id  The ID of the user to retrieve.
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Handle user login request.
     *
     * This method validates the login credentials from the request, attempts to log the user in,
     * checks if the user's email is verified, and then redirects accordingly.
     * If authentication fails, the user is redirected back with an error message.
     *
     * Expected request data:
     * - email: required, string, must be a valid email format, max length 50
     * - password: required, string
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing login credentials.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processLogin(Request $req) 
    {
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

    /**
     * Handle user registration request.
     *
     * This method validates the registration data from the request,
     * creates a new user with the provided credentials,
     * sends a verification email, and redirects the user to the login page.
     *
     * Expected request data:
     * - name: required, string, max length 20
     * - email: required, string, must be a valid email format, max length 50, must be unique in `users` table
     * - password: required, string
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing registration data.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function processRegister(Request $req) 
    {
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

    /**
     * Send email verification link to the authenticated user.
     *
     * This method checks if the currently authenticated user's email is not verified.
     * If not verified, it attempts to send a verification email using the `SendVerificationLink` Mailable.
     * The user is then redirected to the home page with a corresponding success or warning message.
     *
     * Requirements:
     * - User must be authenticated.
     * - User must be unvalidated.
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmailVerification(Request $req) 
    {
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

    /**
     * Verify a user's email and log them in if not already authenticated.
     *
     * This method checks if the given user's `verified_at` field is null.
     * If not verified, it sets the current date and time as the verification timestamp,
     * saves the change, and logs in the user if they aren't already logged in.
     * Finally, it redirects the user to the home page with a success message.
     * If the user is already verified, it aborts with a 404 error.
     *
     * @param  \App\Models\User  $id  The user instance to verify.
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function verify(User $id) 
    {
        if (!$id->verified_at) {
            $id->verified_at = date('Y-m-d H:i:s');
            $id->save();
    
            if (!Auth::check()) Auth::login($id);
            return redirect()->route('home')->with('success', "Email Verification Successful!");
        }
        abort(404);
    }

    /**
     * Log out the currently authenticated user.
     *
     * This method logs out the user using Laravel's Auth system,
     * invalidates the current session to prevent reuse,
     * regenerates a new session token, and redirects the user to the login page
     * with a success message.
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $req) 
    {
        Auth::logout();
        $req->session()->invalidate();
        $req->session()->regenerate();
        return redirect()->route('login')->with('success', "Logout successful!");
    }

    /**
     * Update user data.
     *
     * This method validates incoming request data for updating a user's information.
     * If certain optional fields (`full_name` or `phone_number`) are present but null,
     * they are replaced with empty strings to avoid database issues.
     * Then, it performs a lookup by user ID and updates the user record with the validated data.
     * It handles potential exceptions gracefully and provides appropriate feedback messages.
     *
     * Expected request data:
     * - id: string, required — the user's unique identifier
     * - name: string, required, max 20 characters — the user's display name
     * - full_name: string, optional (nullable), max 100 characters — user's full legal name
     * - role: string, required, must be one of: `admin`, `user` — user's role in the system
     * - email: string, required, valid email format — user's email address
     * - phone_number: string, optional (nullable) — user's phone number
     * - free_limit: integer, required — numeric limit assigned to the user
     * - verified_at: date, optional (nullable) — date when the user was verified
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing update data.
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Delete a user and their associated profile photo.
     *
     * This method checks if the currently authenticated user has the necessary permissions (role is `admin`) 
     * to delete a user. It performs a lookup by user ID, deletes the associated profile photo from storage, 
     * and then deletes the user record. If the authenticated user is not an admin, they will be redirected
     * with a warning message. It handles potential errors and provides feedback to the user.
     *
     * Expected request data:
     * - id: string, required — the UUID of the user to delete.
     *
     * @param  \Illuminate\Http\Request  $req  The HTTP request instance containing the ID of the user to delete.
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $req) 
    {
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
