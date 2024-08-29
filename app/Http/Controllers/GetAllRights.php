<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GetAllRights extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $results = DB::select('select ds.*,df.Formulaire from Droits_Speciaux ds
                    inner join Droits_Formulaires df on ds.Cle_formulaire = df.Code');
        return response()->json($results);

    }
}
