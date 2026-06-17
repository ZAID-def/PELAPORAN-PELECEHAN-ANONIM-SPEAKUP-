<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChatController extends Controller
{
    public function index()
    {
        return view('admin.chat');
    }

    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'session_id' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'session_id' => $data['session_id'],
            'message' => $data['message'],
            'sender' => 'user',
            'is_read' => false,
        ]);

        return response()->json(['chat' => $chat], 201);
    }

    public function adminReply(Request $request)
    {
        $data = $request->validate([
            'session_id' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $chat = Chat::create([
            'session_id' => $data['session_id'],
            'message' => $data['message'],
            'sender' => 'admin',
            'is_read' => true,
        ]);

        return response()->json(['chat' => $chat], 201);
    }

    public function getMessages(Request $request)
    {
        $sessionId = $request->query('session_id');

        if (!$sessionId) {
            return response()->json(['message' => 'session_id is required'], 400);
        }

        if ($request->user()) {
            Chat::where('session_id', $sessionId)
                ->where('sender', 'user')
                ->where('is_read', false)
                ->update(['is_read' => true]);
        }

        $messages = Chat::where('session_id', $sessionId)
            ->orderBy('created_at')
            ->get();

        return response()->json(['messages' => $messages]);
    }

    public function sessions()
    {
        $sessions = Chat::query()
            ->select('session_id')
            ->selectRaw('MAX(created_at) as last_activity')
            ->selectRaw('COUNT(CASE WHEN sender = "user" AND is_read = 0 THEN 1 END) as unread_count')
            ->groupBy('session_id')
            ->orderByDesc('last_activity')
            ->get();

        return response()->json(['sessions' => $sessions]);
    }
    
    public function deleteSession($sessionId)
    {
        Chat::where('session_id', $sessionId)->delete();

        return response()->json(['deleted' => true]);
    }

    public function deleteMessage($id)
    {
        $chat = Chat::findOrFail($id);
        $chat->delete();

        return response()->json(['deleted' => true]);
    }
}