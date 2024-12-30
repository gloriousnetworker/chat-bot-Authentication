<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Login Route
Route::post('/api-login', function (Request $request) {
    // Validate the input
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    // Attempt to find the user by email
    $user = User::where('email', $request->email)->first();

    // Verify credentials
    if (! $user || ! Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    // Generate token
    $token = $user->createToken('api-token')->plainTextToken;

    // Return token as response
    return response()->json([
        'message' => 'Login successful',
        'token' => $token,
    ]);
})->name('api.login'); // Added explicit name for login route

// Protected Routes
Route::middleware('auth:sanctum')->group(function () {
    // Fetch messages
    Route::get('/messages', [\App\Http\Controllers\MessageController::class, 'index'])
        ->name('api.messages.index'); // Added explicit name for fetching messages

    // Send a message
    Route::post('/messages', [\App\Http\Controllers\MessageController::class, 'store'])
        ->name('api.messages.store'); // Added explicit name for sending messages
});
