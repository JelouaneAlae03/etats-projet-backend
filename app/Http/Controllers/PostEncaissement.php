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
        $query = DB::table('V_Vente')
            ->select('Projet','Tranche','GH','Immeuble','Bien', 'Nature', 'Etage' , 'Standing', 'client' ,'num_dossier','date_reservation', 'Date_concretisation','Date_Validation','Prix_Vente','total','Reliquat','Commercial'); 
        
        $fEntre = $filters['fEntre'] ?? null;
        $fEt = $filters['fEt'] ?? null;
        $fSelectEntre = $filters['fSelectEntre'] ?? null;

        foreach ($filters as $key => $value) {
            if (in_array($key, ['fEntre', 'fEt', 'fSelectEntre'])) {
                continue;
            }
            if (!is_null($value)) {
                $query->where($key, $value);
            }
        }
        
        if (!is_null($fEntre) && !is_null($fEt) && !is_null($fSelectEntre)) {
            $query->whereBetween($fSelectEntre, [$fEntre, $fEt]);
        }

        $results = $query->get();
    
        return response()->json($results);
        // $results = DB::select('select Bien , Nature ,Etage ,
        //  Standing ,client , num_dossier , Prix_Vente , Reliquat , Commercial
        //   from V_Vente');
    }
}
