<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home Route
Route::get('/', function () {
    return view('welcome');
});

// Dashboard Route (requires authentication and email verification)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Protected Profile Routes (using ProfileController)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// New Simple Profile Route (directly displays a welcome message with the user's name)
Route::get('/profile/welcome', function () {
    return 'Welcome to your profile page, ' . auth()->user()->name;
})->middleware('auth');

// Authentication Routes
require __DIR__.'/auth.php';
