<?php

namespace App\Http\Middleware;

use Closure;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response as ResponseStatus;

class TokenExpirationMiddleware
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
        $expiration = $request->user()->api_token_expiration;
        $actualDate = new Carbon();
        $date = new Carbon($expiration);
        
        if ($date->lessThan($actualDate)) {
            return response()->json([
                'error' => 'Token expired'
            ], ResponseStatus::HTTP_UNAUTHORIZED);
        }
        return $next($request);
    }
}
