<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Droits extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getForm()
    {
        $results = DB::select('SELECT Code, Formulaire, Descriptif FROM Droits_Formulaires');
        return response()->json($results);
    }
    public function getAllUserDroits(Request $request){
        $numUtilisateur = $request->input('NumUtilisateur');
        $results = DB::select('SELECT Code_Droit as Code FROM Droits_Speciaux_Utilisateur where Code_Utilisateur = ?', [$numUtilisateur]);
        return response()->json($results);
    }
    public function index()
    {
        $results = DB::select('SELECT * FROM Droits_Speciaux');
        return response()->json($results);
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
        $code = $request->input('Code');
        $droit = $request->input('Droit');
        $formulaire = $request->input('Formulaire');
        $descriptif = $request->input('Descriptif');

        $inserted = DB::insert('INSERT INTO Droits_Speciaux (Cle, Droit, Cle_Formulaire, Descriptif) VALUES (?, ?, ?, ?)', 
                            [$code, $droit, $formulaire, $descriptif]);

        if ($inserted) {
            return response()->json(['message' => 'Data inserted successfully'], 201);
        } else {
            return response()->json(['message' => 'Data insertion failed'], 500);
        }
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
    public function update(Request $request)
    {
        $code = $request->input('Code');
        $droit = $request->input('Droit');
        $formulaire = $request->input('Formulaire');
        $descriptif = $request->input('Descriptif');

        $updated =  DB::update('UPDATE Droits_Speciaux SET Droit = ?, Cle_Formulaire = ?, Descriptif = ? WHERE Cle = ?', [$droit, $formulaire, $descriptif, $code]);

        if ($updated) {
            return response()->json(['message' => 'Data updated successfully'], 201);
        } else {
            return response()->json(['message' => 'Data updated failed'], 500);
        }
        

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
