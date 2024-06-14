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
            "individuel.id as user_id",
            "individuel.nom as nom",
            "individuel.prenom as prenom",
            "domain.domain as domain",
            "demandes.created_at",
            "demandes.experience",
            "demandes.niveau",
            "demandes.description",
            "city.name as location",
            "role"
        )->orderBy("created_at")
            ->join("individuel", "individuel.user_id", "=", "demandes.user_id")
            ->leftJoin("city", "city.id", "=", "demandes.location")
            ->leftJoin("domain", "individuel.domain", "=", "domain.id");
        if ($request->input("q")) {
            $q = "%" . $request->input("q") . "%";
            $demandes = $demandes->where(function ($query) use ($q) {
                $query->where("role", "like", $q)->orWhere("demandes.description", "like", $q);
            });
        }
        ;
        if ($request->input("city")) {
            $city = $request->input("city");
            $demandes = $demandes->where("city.id", "=", $city);
        }
        ;
        if ($request->input("salary")) {
            $salary = $request->input("salary");
            $demandes = $demandes->where("salaire", ">", $salary);
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
        $request->validate(
            [
                "salary" => "numeric",
                "city" => "integer",
                "experience" => "integer",
            ]
        );
        try {
            $data = $request->post();
            $data["user_id"] = \Auth::id();
            $data["created_at"]= now();
            if (Demandes::insert($data)) {
                return \Response::json(["message" => "offer added succesfuly"]);
            }
            ;
        } catch (\Exception $e) {
            return \Response::json([ "message" => $e->getMessage()] , 404);
        }
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
        $demande = Demandes::findOrFail($id);
        if ($demande->user_id == \Auth::id()) {
            Demandes::find($id)->delete();
            return \Response::json(["message" => "success"]);
        }
    }
}
