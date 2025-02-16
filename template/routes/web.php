<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use PharIo\Manifest\AuthorElementCollection;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\MidtransController;
use App\Models\User;
use App\Http\Controllers\PaymentController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('unverified');
Route::get('/verify-user/{id}', [AuthController::class, 'verify']);
Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');

// Route::get('/test', function() {
//     return view('auth.email', [
//         'mailData' => [
//             'user_id' => Str::uuid(),
//             'username' => "fami0110"
//         ]
//     ]);
// });

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/need-to-verify', [AuthController::class, 'needToVerify']);
    Route::get('/send-verification-email', [AuthController::class, 'sendEmailVerification']);

    Route::middleware('verified')->group(function () {
        Route::get('/content', [HomeController::class, 'content'])->name('content');
        Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
        Route::get('/favorites', [HomeController::class, 'favorites'])->name('favorites');
        Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');
        Route::get('/history_download', [HomeController::class, 'history_download'])->name('history_download');
        Route::get('/upload', [HomeController::class, 'upload'])->name(name: 'upload');
        Route::post('/upload', [ContentController::class, 'upload'])->name('upload.content');
        Route::get('/profile', [HomeController::class, 'profile'])->name('profile');
        Route::get('/profile/{id}', action: function ($id) {
            $user = User::findOrFail($id);
            return view('user.profile', compact('user')); 
        });
        Route::post('/midtrans/token', [MidtransController::class, 'getToken']);
        // Route::get('/payment', [HomeController::class, 'payment'])->name('payment');
        Route::post('/pricing', [PaymentController::class, 'createTransaction'])->name(name: 'create.transaction');
        Route::post('/payment-notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');
    });

    Route::middleware('admin')->group(function () {

    });
});

Route::middleware('guest')->group(function () {

    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'processLogin']);

    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'processRegister']);

    // Route::get('/password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');

    // Socialite Handler
    Route::get('/auth/google/redirect', [SocialiteController::class, 'redirect'])->name('google-auth');
    Route::get('/auth/google/callback', [SocialiteController::class, 'callback']);
});

// ------

