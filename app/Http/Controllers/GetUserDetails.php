<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GetUserDetails extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $Cle = $request->input('Cle');
        Log::info('Cle: ' . $Cle);
    
        $results = DB::select('SELECT * FROM Utilisateur WHERE Cle = ?', [$Cle]);
        Log::info('Results: ' . json_encode($results));
    
        return response()->json($results);
    }
}
