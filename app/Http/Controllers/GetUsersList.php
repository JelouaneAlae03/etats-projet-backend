<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GetUsersList extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $userID = $request->cookie('userID');
    
        $results = DB::select('SELECT Cle, Nom, Description FROM Utilisateur');
    
        return response()->json([
            'userID' => $userID,
            'results' => $results
        ]);
    }
}
