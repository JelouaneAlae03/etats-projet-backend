<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EtatEncaissement extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $results = DB::select('SELECT * FROM V_Encaissement');
        return response()->json($results);
    }
}
