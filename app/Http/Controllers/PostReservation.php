<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostReservation extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $filters = $request->input('conditions', []);
        log::info($filters);
        $query = DB::table('V_Vente')
            ->select('Projet','Tranche','GH','Immeuble','Bien', 'Nature', 'Etage' , 'Standing', 'client' ,'num_dossier','date_reservation', 'Date_concretisation','Date_Validation','Prix_Vente','total','Reliquat','Commercial'); 
        
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
            $query->whereBetween($fSelectEntre, [$fEntre, $fEt]);
        }
        if (!is_null($sEntre) && !is_null($sEt) && !is_null($sSelectEntre)) {
            $query->whereBetween(DB::raw('CAST(' . $sSelectEntre . ' AS DATE)'), [$sEntre, $sEt]);
        }

        $results = $query->get();
    
        return response()->json($results);
        // $results = DB::select('select Bien , Nature ,Etage ,
        //  Standing ,client , num_dossier , Prix_Vente , Reliquat , Commercial
        //   from V_Vente');
    }
}
