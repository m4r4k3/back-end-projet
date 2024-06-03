<?php

namespace App\Http\Controllers;

use App\Models\Demandes;
use App\Models\TypeContrat;
use Illuminate\Http\Request;

class DemandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $demandes = Demandes::select(
            "demandes.id",
            "demandes.salaire",
            "individuel.nom as nom",
            "individuel.prenom as prenom",
            "domain.domain as domain",
            "location",
            "demandes.created_at",
            "demandes.experience",
            "demandes.niveau",
            "demandes.description",
            "role"
        )->orderBy("created_at")->join("individuel", "individuel.user_id", "=", "demandes.user_id")->join("domain", "individuel.domain", "=", "domain.id");
        if ($request->has("q")) {
            $q = "%" . $request->input("q") . "%";
            $demandes = $demandes->where(function ($query) use ($q) {
                $query->where("role", "like", $q)->orWhere("description", "like", $q);
            });
        }
        ;
        if ($request->has("city")) {
            $city = $request->input("city");
            $demandes = $demandes->where("city", "=", $city);
        }
        ;
        if ($request->has("salary")) {
            $salary = $request->input("salary");
            $demandes = $demandes->where("salary", ">", $salary);
        }
        ;

        $demandes = $demandes->limit(30)->get();
        return \Response::json($demandes);
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
        $demand = Demandes::find($id);
        return \Response::json($demand);
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