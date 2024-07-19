<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class EtatReservation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $results = DB::select('SELECT Societe , Projet , GH , Immeuble , Etage ,
         Nature , Standing , Commercial , Ville_Adresse , Tranche  FROM V_Vente');
        return response()->json($results);
    }
}
