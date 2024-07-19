<?php

namespace App\Http\Controllers;
use App\Models\Etat;
use Illuminate\Http\Request;

class EtatController extends Controller
{
    public function index()
    {
        $records = Etat::orderBy('OrdreModule')
               ->where('Fiable', '1')
               ->get();
        return response()->json($records);
    }
}
