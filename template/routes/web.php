<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware('auth')->group(function () {


    Route::middleware('admin')->group(function () {
    
    });
});

Route::middleware('guest')->group(function () {
    // Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    // Route::post('/login', [LoginController::class, 'login']);
    // Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    // Route::post('/register', [RegisterController::class,'register']);
    // Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    // Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    // Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    // Route::get('/password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
});


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/content', [HomeController::class, 'content'])->name('content');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/favorites', [HomeController::class, 'favorites'])->name('favorites');
Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');
Route::get('/history_download', [HomeController::class, 'history_download'])->name('history_download');


// Socialite Handler
Route::get('/auth/redirect', [SocialiteController::class, 'redirect']);
Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);