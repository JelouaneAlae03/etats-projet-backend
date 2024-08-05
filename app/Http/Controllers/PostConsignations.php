<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PostConsignations extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $filters = $request->input('conditions', []);
        Log::info($filters);
        
        $query = DB::table('V_Consignation')
            ->select('Projet', 'Immeuble' ,'Tranche', 'GH', 'client', 'Immeuble', 'Bien', 'Nature', 'Etage', 'etat', 'Standing', 'prix_vente', 'Date_Consignation', 'total', 'Date_Prevue_Paiement', 'Montant_Regularise');
        
        $filterKeys = ['fEntre', 'fEt', 'fSelectEntre', 'sSelectMontant'];
        foreach ($filterKeys as $key) {
            $$key = $filters[$key] ?? null;
        }
        
        if (!is_null($sSelectMontant)) {
            if ($sSelectMontant === 'R') {
                $query->where('Montant_Regularise', '>', 0);
            } elseif ($sSelectMontant === 'N') {
                $query->where('Montant_Regularise', '<=', 0);
            }
        }
        
        if (!is_null($fEntre) && !is_null($fEt) && !is_null($fSelectEntre)) {
            $query->whereBetween($fSelectEntre, [$fEntre, $fEt]);
        }
        
        $results = $query->get();
        
        return response()->json($results);
    }
}
