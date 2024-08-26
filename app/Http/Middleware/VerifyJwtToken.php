<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Illuminate\Support\Facades\Log;


class VerifyJwtToken extends BaseMiddleware
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
        // Check if the token exists in the cookies
        $token = $request->cookie('token');
        log::info('token  '.$token);

        
        if (!$token) {
            return response()->json([
                'success' => false,
                'message' => 'Token not provided'
            ], 401);
        }

        try {
            // Parse the token to get the payload
            $payload = JWTAuth::parseToken()->getPayload();
            Log::info('JWT Payload: ' . json_encode($payload->toArray()));
            $userId = $payload->get('sub');  // This should correspond to 'Cle'

            
            // Manually retrieve the user by the custom primary key
            $user = \App\Models\User::find($userId);
            
            Log::info('Authenticated user: ' . json_encode($user));
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Token is invalid'], 401);
            }
        } catch (Exception $e) {
            Log::error('JWT Authentication Error: ' . $e->getMessage());
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException) {
                return response()->json(['message' => 'Token is invalid'], 401);
            } elseif ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException) {
                return response()->json(['message' => 'Token has expired'], 401);
            } else {
                return response()->json(['message' => 'Authorization token not found'], 401);
            }
        }
        return $next($request);
    }
}
