<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // Fetch messages
    public function index(Request $request)
    {
        // Assuming the user is authenticated
        $user = $request->user();

        // Fetch all messages for the authenticated user
        $messages = Message::where('recipient_id', $user->id)->get();

        return response()->json($messages);
    }

    // Store a message
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'recipient_id' => 'required|exists:users,id',  // Ensure the recipient exists
            'message' => 'required|string',
        ]);

        // Create a new message
        $message = Message::create([
            'sender_id' => $request->user()->id,  // Get the authenticated user's ID
            'recipient_id' => $request->recipient_id,
            'message' => $request->message,
        ]);

        return response()->json(['message' => 'Message sent successfully', 'data' => $message], 201);
    }
}
