<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AfectDroitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getDroit(Request $request){
        $id = $request->input('NumUtilisateur');
        log::info($id);
        $results = DB::select('select ds.Cle as Cle_Droit, ds.Droit as Droit_Nom, ds.Descriptif as Droit_Descriptif, dsu.Code_Utilisateur,
        u.Nom as Nom_Utilisateur,
    dsu.Code_Formulaire , 
    df.Formulaire as Formulaire_Nom ,
    df.Descriptif as Formulaire_Descriptif 
    from Droits_Speciaux ds 
    inner join Droits_Speciaux_Utilisateur dsu on ds.Cle = dsu.Code_Droit and dsu.code_Formulaire = ds.Cle_formulaire
    inner join Droits_Formulaires df on dsu.code_Formulaire = df.Code
    inner join Utilisateur u on dsu.Code_Utilisateur = u.Cle where dsu.Code_Utilisateur = ?', [$request->NumUtilisateur]);

        return response()->json($results);
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
