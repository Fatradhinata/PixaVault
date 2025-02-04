<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware('verified')->group(function () {
        Route::get('/content', [HomeController::class, 'content'])->name('content');
        Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
        Route::get('/favorites', [HomeController::class, 'favorites'])->name('favorites');
        Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');
        Route::get('/history_download', [HomeController::class, 'history_download'])->name('history_download');
    });

    Route::middleware('admin')->group(function () {
    
    });
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    // Route::post('/login', [LoginController::class, 'login']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    // Route::post('/register', [RegisterController::class,'register']);
    
    // Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    
    // Socialite Handler
    Route::get('/auth/redirect', [SocialiteController::class, 'redirect'])->name('google-auth');
    Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
});
