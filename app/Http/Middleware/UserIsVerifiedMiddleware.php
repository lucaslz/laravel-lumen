<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class UserIsVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->user()->verified === false) {
            return response()->json([
                'error' => 'User not verified'
            ], ResponseStatus::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}