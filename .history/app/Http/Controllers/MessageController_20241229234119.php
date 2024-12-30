<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Retrieve all messages with their associated user
    public function index()
    {
        return Message::with('user')->latest()->get();
    }

    // Store a new message
    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create the message
        $message = Message::create([
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        // Return the created message with user details
        return $message->load('user');
    }
}

