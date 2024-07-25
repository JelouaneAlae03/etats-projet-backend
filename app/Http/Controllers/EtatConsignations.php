<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EtatConsignations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $results = DB::select('SELECT Projet , GH , Immeuble , Etage ,
        Nature , Standing , Tranche  FROM V_Consignation');
       return response()->json($results);
    }
}
