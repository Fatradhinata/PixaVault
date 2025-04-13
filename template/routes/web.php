<?php

use App\Models\User;
use App\Models\Content;
use App\Models\Payment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MidtransController;
use PharIo\Manifest\AuthorElementCollection;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\LeaderboardController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TokenController;

Route::get('/', [HomeController::class, 'index'])->name('home')->middleware('unverified');
Route::get('/verify-user/{id}', [AuthController::class, 'verify']);

Route::get('/trending', [ContentController::class, 'trending'])->name('trending');
Route::get('/result', [ContentController::class, 'result'])->name('result');
Route::get('/explore', [ContentController::class, 'index'])->name('explore');
Route::get('/pricing', [PaymentController::class, 'index'])->name('pricing');
Route::get('/leaderboard', [LeaderboardController::class, 'index'])->name('leaderboard');

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
        Route::get('/history_download', [HomeController::class, 'history_download'])->name('history_download');

        Route::get('/content/download/{id}', [ContentController::class, 'downloadImage'])->name('image.download');
        Route::get('/content/like/{id}', [ContentController::class, 'updateLike']);
        Route::get('/upload', [ContentController::class, 'upload'])->name('upload');
        Route::post('/upload', [ContentController::class, 'store']);
        Route::get('/api/tags', [ContentController::class, 'initialTags']);       
        Route::get('/api/tags/search', [ContentController::class, 'searchTags']);

        Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
        Route::post('/content/{id}', [ContentController::class, 'update'])->name('content.update')->middleware('auth');
        Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
        Route::post('/comment/{commentId}/like', [CommentLikeController::class, 'likeComment']);
        Route::delete('/comment/{commentId}/unlike', [CommentLikeController::class, 'unlikeComment']);

        Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
        Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile/edit', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profile/edit', [ProfileController::class, 'changePassword'])->name('profile.password');
        Route::get('/profile/{id}', [ProfileController::class, 'details'])->name('user.profile');
        Route::post('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
        Route::post('/follow/{id}', [ProfileController::class, 'toggleFollow'])->middleware('auth')->name('profile.follow');
        
        Route::post('/report-content', [ReportController::class, 'store']);
        
        Route::get('/subscription', [SubscriptionController::class, 'index'])->name('subscription');
        Route::post('/purchase/{type}', [PaymentController::class, 'purchase'])->name('purchase');
        Route::post('/extends/{type}', [PaymentController::class, 'extends'])->name('extends');
        Route::get('/checkout/{id}/{snapToken}', [PaymentController::class, 'checkout'])->name('checkout');
        Route::get('/payment/{orderId}', [PaymentController::class, 'payment'])->name('payment');
        Route::delete('/payment/{id}', [PaymentController::class, 'cancelPayment'])->name('payment.cancel');

        Route::get('/activation/{id}', [TokenController::class, 'activateToken'])->name('tokenActivation');
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin');

        Route::get('/admin/content', [AdminController::class, 'content'])->name('admin.content');
        Route::delete('/admin/content', [ContentController::class, 'destroy']);

        Route::get('/admin/subscription', [AdminController::class, 'subscription'])->name('admin.subscription');
        Route::get('/admin/subscription/{id}', [SubscriptionController::class, 'getDataById']);
        Route::put('/admin/subscription', [SubscriptionController::class, 'update']);
        Route::delete('/admin/subscription', [SubscriptionController::class, 'destroy']);

        Route::get('/admin/payment', [AdminController::class, 'payment'])->name('admin.payment');
        Route::delete('/admin/payment', [PaymentController::class, 'destroy']); 
        
        Route::get('/admin/leaderboard', [AdminController::class, 'leaderboard'])->name('admin.leaderboard');
        Route::post('/admin/leaderboard', [LeaderboardController::class, 'sendGift']);
        
        Route::get('/admin/users', [AdminController::class, 'users'])->name('admin.users');
        Route::get('/admin/users/{id}', [AuthController::class, 'getDataById']);
        Route::put('/admin/users', [AuthController::class, 'update']);
        Route::delete('/admin/users', [AuthController::class, 'destroy']);
        
        Route::get('/admin/report', [AdminController::class, 'report'])->name('admin.report');
        Route::get('/admin/report/{id}', [ReportController::class, 'getDataById']);
        Route::get('/admin/report/resolve/{id}', [ReportController::class, 'resolve']);
        Route::delete('/admin/report', [ReportController::class, 'destroy']);
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

