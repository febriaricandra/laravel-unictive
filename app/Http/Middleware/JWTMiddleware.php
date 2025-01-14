<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->hasHeader('Authorization')) {
            return response()->json(['error' => 'Token not provided'], 401);
        }
        
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (JWTException $e) {
            Log::error('JWT Exception: ' . $e->getMessage());
            return response()->json(['error' => 'Token not valid'], 401);
        }

        return $next($request);
    }
}
