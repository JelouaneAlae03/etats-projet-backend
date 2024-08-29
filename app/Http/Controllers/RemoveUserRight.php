<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class RemoveUserRight extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        log::info('dkheel');

        $data = $request->only(['Code_Droit', 'Code_Formulaire', 'Code_Utilisateur']);
        log::info($data);


        try {
            DB::table('Droits_Speciaux_Utilisateur')
                ->where([
                    ['Code_Droit', '=', $data['Code_Droit']],
                    ['Code_Formulaire', '=', $data['Code_Formulaire']],
                    ['Code_Utilisateur', '=', $data['Code_Utilisateur']]
                ])
                ->delete();

            return response()->json(['message' => 'Right removed successfully']);
        } catch (\Exception $e) {
            // Return a JSON error response
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
}
