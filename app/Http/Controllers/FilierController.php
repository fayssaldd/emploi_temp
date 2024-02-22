<?php

namespace App\Http\Controllers;

use App\Http\Resources\FilierResource;
use App\Models\Filier;
use App\Models\Formateur;
use Illuminate\Http\Request;

class FilierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $filiers = FilierResource::collection(Filier::all());
        return view('filiers.index',compact('filiers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formateurs = Formateur::all();
        return view('filiers.create',compact('formateurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            'nom' => 'required|unique:filiers|max:255',
            "formateurs_ids"=>"required",
        ]);
        if(isset($formFields['formateurs_ids'])){
            $formateurs_ids = $formFields['formateurs_ids'];
            $formateurs = Formateur::findOrFail($formateurs_ids);
        }
        // dd($formateurs);

        $filier = Filier::create($formFields);
        $filier->formateurs()->attach($formateurs);
        return redirect()->route('filier.index')->with('success','Filiers est bien ajouter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Filier $filier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Filier $filier)
    {
        return view('filiers.update',compact('filier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Filier $filier)
    {
        $formFields = $request->validate([
            'nom' => 'required|unique:filiers|max:255'
        ]);
        $filier->update($formFields);
        return redirect()->route('filier.index')->with('success','Filiers est bien Modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Filier $filier)
    {
        $filier->delete();
        return redirect()->route('filier.index')->with('success','FIlier à été bien suppirmer');
    }
}
