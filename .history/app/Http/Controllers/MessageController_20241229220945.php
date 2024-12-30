<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Fetch all messages with their associated user
    public function index()
    {
        return Message::with('user')->latest()->get();
    }

    // Store a new message
    public function store(Request $request)
    {
        // Validate the request input
        $validated = $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Create a new message
        $message = Message::create([
            'user_id' => auth()->id(),  // Use the authenticated user's ID
            'content' => $validated['content'],
        ]);

        // Return the newly created message with user data
        return response()->json($message->load('user'), 201);
    }
}
