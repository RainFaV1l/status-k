<?php

namespace Modules\Auth\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckBanMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(auth()->user() && auth()->user()->is_banned) {
            abort(403);
        }
        return $next($request);
    }
}
