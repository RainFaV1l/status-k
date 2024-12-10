<?php

namespace Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Auth\Events\MessageSent;
use Modules\Auth\Models\User;
use Modules\Auth\Models\ChatMessage;

class ChatController extends Controller
{
    public function index()
    {
        $users = ChatMessage::query()->select(DB::raw('COUNT(sender_id) as sender_count, sender_id, full_name'))
            ->where('receiver_id', auth()->user()->id)->orWhere('sender_id')->join('users', 'sender_id', '=','users.id')->groupBy(['sender_id', 'full_name'])->get();
        return view('auth::chats', compact('users'));
    }

    public function show(int $user)
    {
        $friend = User::query()->find($user);
        $user_id = auth()->user()->id;

        return view('auth::chat', compact('friend', 'user_id'));
    }

    public function message(User $user)
    {
        return ChatMessage::query()
            ->where(function ($query) use ($user) {
                $query->where('sender_id', auth()->user()->id)->where('receiver_id', $user->id);
            })
            ->orWhere(function ($query) use ($user) {
                $query->where('sender_id', $user->id)->where('receiver_id', auth()->user()->id);
            })
            ->with(['sender', 'receiver'])
            ->orderBy('id')
            ->get();
    }

    public function send(User $user)
    {
        $message = ChatMessage::query()->create([
            'sender_id' => auth()->user()->id,
            'receiver_id' => $user->id,
            'message' => request()->input('message')
        ]);

        broadcast(new MessageSent($message));

        return $message;
    }
}
