<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ChangeUserDetails extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'Nom' => 'required|string|max:255',
            'NomC' => 'required|string',
            'Description' => 'required|string|max:255',
            'Password' => 'required|string',
            'Desactiver' => 'required|string',

        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        
        $user->Nom = $request->input('Nom');
        $user->Nom_Complet = $request->input('NomC');
        $user->Description = $request->input('Description');
        //$user->Mot_Passe = $request->input('Password');
        $user->Compte_Desactive = intval($request->input('Desactiver'));

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user], 200);





    }
}
