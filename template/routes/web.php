<?php

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MidtransController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use PharIo\Manifest\AuthorElementCollection;
use App\Http\Controllers\SocialiteController;
use App\Models\Content;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('unverified');
Route::get('/verify-user/{id}', [AuthController::class, 'verify']);

Route::get('/pricing', [HomeController::class, 'pricing'])->name('pricing');
Route::get('/trending', [HomeController::class, 'trending'])->name('trending');

Route::get('/result', [ContentController::class, 'result'])->name('result');
Route::get('/explore', [ContentController::class, 'index'])->name('explore');

// APIs
Route::get('/image/{publicId}', [ContentController::class, 'showImage'])->name('image');
Route::get('/content/{id}', [ContentController::class, 'getDataById']);
Route::get('/content/get/{limit}', [ContentController::class, 'getRandom']);
Route::get('/comments/{id_content}', [CommentController::class, 'index'])->name('comments.index');


Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/need-to-verify', [AuthController::class, 'needToVerify']);
    Route::get('/send-verification-email', [AuthController::class, 'sendEmailVerification']);

    Route::middleware('verified')->group(function () {
        Route::get('/blog', [HomeController::class, 'blog'])->name('content');
        Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
        Route::get('/favorites', [HomeController::class, 'favorites'])->name('favorites');
        Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');
        Route::get('/history_download', [HomeController::class, 'history_download'])->name('history_download');

        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');

        Route::get('/content/download/{id}', [ContentController::class, 'downloadImage'])->name('image.download');
        Route::get('/content/like/{id}', [ContentController::class, 'updateLike']);
        Route::get('/upload', [ContentController::class, 'upload'])->name('upload');
        Route::post('/upload', [ContentController::class, 'store']);

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::get('/profile/{id}', [ProfileController::class, 'details']);

        Route::post('/midtrans/token', [MidtransController::class, 'getToken']);
        Route::post('/report-content', [ReportController::class, 'store']);

        Route::get('/payment', [HomeController::class, 'payment'])->name('payment');
        Route::get('/payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');
        Route::post('/pricing', [PaymentController::class, 'createTransaction'])->name('create.transaction');
        Route::post('/payment-notification', [PaymentController::class, 'handleNotification'])->name('payment.notification');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');
        Route::get('/admin/content', [AdminController::class, 'content'])->name('admin.content');
        Route::get('/admin/subscription', [AdminController::class, 'subscription'])->name('admin.subscription');
        Route::get('/admin/user', [AdminController::class, 'user'])->name('admin.user-admin');
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
