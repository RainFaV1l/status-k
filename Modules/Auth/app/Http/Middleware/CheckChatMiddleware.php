<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\Auth\Models\ChatMessage;

class CheckChatMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        $check = ChatMessage::query()->where('id', $request->route('user'))->where('receiver_id', auth()->user()->id)->orWhere('sender_id', auth()->user()->id)->firstOrFail();
        if(!$check) {
            abort(403);
        }
        return $next($request);
    }
}
