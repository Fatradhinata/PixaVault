<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/content', [HomeController::class, 'content'])->name('content');
Route::get('/blog', [HomeController::class, 'blog'])->name('blog');
Route::get('/leaderboard', [HomeController::class, 'leaderboard'])->name('leaderboard');