<?php

namespace App\Http\Controllers;

use App\Http\Resources\FormateurResource;
use App\Models\Filier;
use App\Models\Formateur;
use Illuminate\Http\Request;

class FormateurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      $formateurs = FormateurResource::collection(Formateur::all());
      return view("formateurs.index", compact("formateurs"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $filiers = Filier::all();
        return view("formateurs.create",compact('filiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "nom"=>"required|string",
            "prenom"=>"required|string",
            "type"=>"required|in:vacataire,permanent",
            "date_formation"=>"sometimes|date",
            "filiers_ids"=>"sometimes",
        ]);
        $filiers = null;
        if(isset($formFields['filiers_ids'])){
            $filiers_ids = $formFields['filiers_ids'];
            $filiers = Filier::findOrFail($filiers_ids);
        }
        $formateurs = Formateur::create($formFields);
        $formateurs->filieres()->attach($filiers);
        return redirect()->route('formateurs.index')->with('success','Formateur est bien ajouter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Formateur $formateur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Formateur $formateur)
    { 
        $ids = [];
        $filiers = Filier::all();
        foreach($formateur->filieres as $filier){
            array_push($ids, $filier->id);
        }
        return view('formateurs.update',compact('formateur','filiers','ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formateur $formateur)
    {
        $formFields = $request->validate([
            "nom"=>"required|string",
            "prenom"=>"required|string",
            "type"=>"required|in:vacataire,permanent",
            "date_formation"=>"sometimes|date",
            "filiers_ids"=>"sometimes",
        ]);
        if($formateur){
            # check filieres_ids if exist
            if (isset($formFields["filiers_ids"])){
                if($formFields["filiers_ids"] === 0){
                    // detach all filieres
                    $formateur->filieres()->detach();
                }else{
                    $filieres_ids = $formFields["filiers_ids"];
                    # try to find the filieres and sync them
                    try {
                        $filieres = Filier::findOrFail($filieres_ids);
                        $formateur->filieres()->sync($filieres);
                    } catch (\Throwable $th) {
                        return response()->json(["success"=>false,
                            "message"=>"ne trouve pas les filieres de ids ".$formFields["filiers_ids"]],
                            400);
                    }
                }
            }
        }
        $formateur->update($formFields);
        return redirect()->route('formateurs.index')->with('success','Formateur est bien Modifer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $formateur)
    {
        $formateur->delete();
        return to_route('formateurs.index')->with('success','Formateur est bien supprimer');
    }
}
