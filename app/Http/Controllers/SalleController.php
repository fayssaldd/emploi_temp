<?php

namespace App\Http\Controllers;

use App\Http\Resources\SalleResource;
use App\Models\Salle;
use Illuminate\Http\Request;

class SalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $salles = SalleResource::collection(Salle::all());
        return view('salles.index',compact('salles'));
    }

    /**
     * 
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('salles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "nom"=>"required|string|unique:salles,nom",
            "description"=>"sometimes|string",
            "status"=>"sometimes|boolean",
            "espace"=>"sometimes|integer",
        ]);
        Salle::create($formFields);
        return to_route('salles.index')->with('success','Salle est bien ajouter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Salle $salle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salle $salle)
    {
        return view('salles.update',compact('salle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Salle $salle)
    {
        $formFields = $request->validate([
            "nom"=>"required|string",
            "description"=>"sometimes|string",
            "status"=>"sometimes|boolean",
            "espace"=>"sometimes|integer",
        ]);
        $salle->update($formFields);
        return to_route('salles.index')->with('success','Salle est bien Modifer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salle $salle)
    {
        $salle->delete();
        return to_route('salles.index')->with('success','Salle est bien supprimer');
    }

    public function deleteMultiple(Request $request)
{
    $selectedSalles = $request->input('ids_salles');
    
    // Assurez-vous que des éléments ont été sélectionnés
    if (!empty($selectedSalles)) {
        // Supprimez les éléments sélectionnés de la base de données
        Salle::whereIn('id', $selectedSalles)->delete();
        
        return redirect()->back()->with('success', 'Éléments sélectionnés supprimés avec succès.');
    } else {
        return redirect()->back()->with('error', 'Aucun élément sélectionné pour la suppression.');
    }
}
}
