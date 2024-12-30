<?php

use App\Http\Controllers\MessageController;
use Illuminate\Support\Facades\Route;

// Protect routes with Sanctum authentication
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/messages', [MessageController::class, 'index']);  // Get all messages
    Route::post('/messages', [MessageController::class, 'store']);  // Store a new message
});
