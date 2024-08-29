<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AddRightsToUser extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'rights' => 'required|array',
            'rights.*.Code_Droit' => 'required|string',
            'rights.*.Code_Formulaire' => 'required|string',
            'rights.*.Code_Utilisateur' => 'required|string',
        ]);

        $rights = $data['rights'];

        // Insert data into the database using DB facade
        DB::table('Droits_Speciaux_Utilisateur')->insert($rights);

        return response()->json(['message' => 'Data inserted successfully']);
    }
}
