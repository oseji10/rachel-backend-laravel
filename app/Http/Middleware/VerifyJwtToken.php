<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class VerifyJwtToken
{
    public function handle(Request $request, Closure $next)
    {
        // Allow OPTIONS requests for CORS preflight
        if ($request->getMethod() === 'OPTIONS') {
            return $next($request);
        }

        // Get token from cookie
        $token = $request->cookie('access_token');
        \Log::info('Access Token: ' . $token);

        if (!$token) {
            \Log::warning('No access_token cookie found');
            return response()->json(['message' => 'Unauthorized - No token'], 401);
        }

        // Validate token format
        if (!preg_match('/^[A-Za-z0-9-_]+\.[A-Za-z0-9-_]+\.[A-Za-z0-9-_]+$/', $token)) {
            \Log::warning('Invalid JWT format');
            return response()->json(['message' => 'Invalid token format'], 401);
        }

        try {
            // Set token and get payload
            JWTAuth::setToken($token);
            $payload = JWTAuth::payload();
            $userId = $payload['sub']; // Extract user ID from token payload

            // Find user by ID
            $user = Users::find($userId);
            if (!$user) {
                \Log::warning('User not found for ID: ' . $userId);
                return response()->json(['message' => 'User not found'], 404);
            }

            // Log in user for the request
            Auth::guard('api')->login($user);

            // Attach payload to request
            $request->merge(['jwt_payload' => (array) $payload]);

        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            \Log::error('Token expired: ' . $e->getMessage());
            return response()->json(['message' => 'Token expired'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            \Log::error('Invalid token: ' . $e->getMessage());
            return response()->json(['message' => 'Invalid token'], 401);
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            \Log::error('JWT error: ' . $e->getMessage());
            return response()->json(['message' => 'Unauthorized - Token error'], 401);
        }

        return $next($request);
    }
}