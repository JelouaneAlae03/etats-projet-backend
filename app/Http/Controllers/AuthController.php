<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'Nom' => 'required|string',
            'Mot_Passe' => 'required|string',
        ]);

        // Fetch user from the database
        $user = User::where('Nom', $request->input('Nom'))->first();
        log::info($user);

        if ($user && Hash::check($request->input('Mot_Passe'), $user->Mot_Passe)) {
            $token = 'generate-your-token-here'; 

            return response()->json([
                'success' => true,
                'user' => $user,
                'token' => $token,
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
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
