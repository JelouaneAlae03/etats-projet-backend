<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class PostStock extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $filters = $request->input('conditions', []);
        log::info($filters);
        $query = DB::table('V_Stock')
            ->select('Projet','Tranche','GH','Immeuble','Bien', 'Nature', 'Etage' ,'etat', 'Standing','prix_vente'); 
        
        $filterKeys = ['fEntre', 'fEt', 'fSelectEntre', 'sEntre', 'sEt', 'sSelectEntre'];
        foreach ($filterKeys as $key) {
            $$key = $filters[$key] ?? null;
        }

        foreach ($filters as $key => $value) {
            if (in_array($key, $filterKeys)) {
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
            $query->whereBetween($sSelectEntre, [$sEntre, $sEt]);
        }

        $results = $query->get();
    
        return response()->json($results);
    }
}
