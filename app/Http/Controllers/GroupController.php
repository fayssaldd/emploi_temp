<?php

namespace App\Http\Controllers;

use App\Http\Resources\GroupeResource;
use App\Models\Filier;
use App\Models\Group;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $groups = GroupeResource::collection(Group::all());
        return view('groups.index',compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $filiers = Filier::all();
        return view('groups.create',compact('filiers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $formFields = $request->validate([
            "nom"=>"required|string|unique:groups,nom",
            "filier_id"=>"required|integer|exists:filiers,id",
        ]);
        Group::create($formFields);
        return to_route('groups.index')->with('success','Group est bien ajouter');
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        $filiers = Filier::all();
        return view('groups.update',compact('group','filiers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Group $group)
    {
        $formFields = $request->validate([
            "nom"=>"sometimes|string",
            "filier_id"=>"sometimes|integer|exists:filiers,id",
        ]);
        $group->update($formFields);
        return to_route('groups.index')->with('success','Group est bien Modifier');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return to_route('groups.index')->with('success','Group est bien supprimer');
    }
}
