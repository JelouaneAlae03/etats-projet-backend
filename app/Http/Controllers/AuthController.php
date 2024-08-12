<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth; 
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{
    public function login(Request $request)
{
    $request->validate([
        'Nom' => 'required|string',
        'Mot_Passe' => 'required|string',
    ]);

    $user = User::where('Nom', $request->input('Nom'))->first();

    // Log request data and user existence
    //Log::info('Request Data:', $request->all());
    //Log::info('User Found:', $user ? $user->toArray() : 'No user found');

    if ($user) {
        // Log user ID if user exists
        //Log::info('User ID: ' . $user->getKey());

        if ($request->input('Mot_Passe') === $user->Mot_Passe) {
            try {

                $token = JWTAuth::fromUser($user);

                // Log the generated token for debugging
                //Log::info('Generated Token: ' . $token);

                return response()->json([
                    'success' => true,
                    'user' => $user,
                    'token' => $token,
                ]);
            } catch (JWTException $e) {
                // Log JWTException errors
                //Log::error('JWTException: ' . $e->getMessage());

                return response()->json([
                    'success' => false,
                    'message' => 'Could not create token',
                ], 500);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials',
            ], 401);
        }
    } else {
        //Log::info('User not found with Nom: ' . $request->input('Nom'));

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }
}

    public function logout(Request $request)
    {
        Auth::logout();
        return response()->json([
            'success' => true,
            'message' => 'Logged out successfully',
        ]);
    }
}
