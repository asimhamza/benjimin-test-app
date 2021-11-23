<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(auth()->user()->role == $role)
        {
            return $next($request);
        }

        return response()->json([
            'status' => 0,
            'message' => 'Access Denied.',
            'content' => null,
        ]);
    }
}
