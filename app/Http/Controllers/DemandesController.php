<?php

namespace App\Http\Controllers;

use App\Models\Demandes;

use Illuminate\Http\Request;
use Response;

class DemandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $demandes = Demandes::with(["city", "individuel", "domain"])
            ->when(
                $request->filled("q"),
                function ($query) use ($request) {
                    $q = "%" . $request->input("q") . "%";
                    $query->where(function ($sub) use ($q) {
                        $sub->where("role", "like", $q)->orWhere("demandes.description", "like", $q)
                            ->orWhereHas(
                                "individuel",
                                function ($subsub) use ($q) {
                                    $subsub->where("nom", "like", $q)->orWhere("prenom", "like", $q);
                                }
                            )
                        ;
                    });
                }
            )->when(
                $request->filled("city"),
                function ($query) use ($request) {
                    $query->where("location", "=", $request->input("city"));
                }
            )->when(
                $request->filled("salary"),
                function ($query) use ($request) {
                    $query->where("salaire", ">", $request->input("salary"));
                }
            )->get()
        ;

        return Response::json($demandes);
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
                "domain" => "integer",
                "experience" => "integer",
            ]
        );
        try {
            $data = $request->post();
            $data["user_id"] = \Auth::id();
            $data["created_at"] = now();
            if (Demandes::insert($data)) {
                return \Response::json(["message" => "offer added succesfuly"]);
            }
            ;
        } catch (\Exception $e) {
            return \Response::json(["message" => $e->getMessage()], 404);
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
            $demande->delete();
            return \Response::json(["message" => "success"]);
        }
    }
}
