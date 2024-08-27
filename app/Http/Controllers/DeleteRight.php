<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DeleteRight extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $droit = $request->dataDelete;
        log::info($droit);
        $query = DB::table('Droits_Speciaux')
        ->where('Cle', $droit['Cle'])
        ->where('Droit', $droit['Droit'])
        ->where('Cle_formulaire', $droit['CleForm'])
        ->where('Descriptif', $droit['Descriptif'])
        ->delete();
        return response()->json(['message' => 'Droit supprimé avec succès'], 200);
    }
}
