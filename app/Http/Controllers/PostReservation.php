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
        foreach ($filters as $key => $value) {
            if (!is_null($value)) {
                $query->where($key, $value);
            }
        }
    
        $results = $query->get();
    
        return response()->json($results);
        // $results = DB::select('select Bien , Nature ,Etage ,
        //  Standing ,client , num_dossier , Prix_Vente , Reliquat , Commercial
        //   from V_Vente');
    }
}
