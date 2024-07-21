<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostEncaissement extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $filters = $request->input('conditions', []);
        log::info($filters);
        $query = DB::table('V_Encaissement')
            ->select('Bien', 'client', 'Prix_Vente' , 'montant', 'Prix_Stock' ,'Num_Recu','Numero', 'Nature','Lib_Banque','Lib_Agence','Lib_Ville','Date_Systeme'); 
        
        $fEntre = $filters['fEntre'] ?? null;
        $fEt = $filters['fEt'] ?? null;
        $fSelectEntre = $filters['fSelectEntre'] ?? null;

        $sEntre = $filters['sEntre'] ?? null;
        $sEt = $filters['sEt'] ?? null;
        $sSelectEntre = $filters['sSelectEntre'] ?? null;

        foreach ($filters as $key => $value) {
            if (in_array($key, ['fEntre', 'fEt', 'fSelectEntre', 'sEntre', 'sEt', 'sSelectEntre'])) {
                continue;
            }
            if (!is_null($value)) {
                $query->where($key, $value);
            }
        }
        
        if (!is_null($fEntre) && !is_null($fEt) && !is_null($fSelectEntre)) {
            $query->whereBetween(DB::raw('CAST(' . $fSelectEntre . ' AS DATE)'), [$fEntre, $fEt]);
        }
        if (!is_null($sEntre) && !is_null($sEt) && !is_null($sSelectEntre)) {
            $query->whereBetween($sSelectEntre, [$sEntre, $sEt]);
        }

        $results = $query->get();
    
        return response()->json($results);
        // $results = DB::select('select Bien , Nature ,Etage ,
        //  Standing ,client , num_dossier , Prix_Vente , Reliquat , Commercial
        //   from V_Vente');
    }
}
