<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Test Route for POST and GET (testing storing and retrieving messages in the session)
Route::middleware('auth')->group(function () {
    // Store a message in the session (POST)
    Route::post('/test-message', function (Request $request) {
        // Validate that 'message' is provided in the body
        $request->validate([
            'message' => 'required|string',
        ]);

        // Store the message in the session
        session(['message' => $request->input('message')]);

        return response()->json(['message' => 'Message stored successfully']);
    });

    // Retrieve the stored message from the session (GET)
    Route::get('/test-message', function () {
        // Retrieve the stored message from the session
        $message = session('message', 'No message found');

        return response()->json(['message' => $message]);
    });
});

// Authentication Routes
require __DIR__.'/auth.php';
