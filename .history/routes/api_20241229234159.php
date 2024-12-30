<?php

use App\Http\Controllers\MessageController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/messages', [MessageController::class, 'index']); // Fetch all messages
    Route::post('/messages', [MessageController::class, 'store']); // Store a new message
});
