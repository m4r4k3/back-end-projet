<?php

namespace App\Http\Controllers;

use App\Models\Individuel;
use App\Models\Offres;
use Illuminate\Http\Request;
use App\Models\User;
use DB;

class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $offres = Offres::with(["city", "contrat", "domain", "entreprise"])
            ->when(
                \Auth::check() && User::find(\Auth::id())->type == 1,
                function ($query) use ($request) {
                    $query->withCount(["applicants as isApplied" => function ($qeury){
                        $qeury->where("applicants.user_id", "=", \Auth::id()) ;
                    }]) ;
                }
            )->when($request->filled("q") , function ($query) use($request){
                $q = "%" . $request->input("q") . "%";
                $query->where(function ($sub) use ($q) {
                    $sub->where("post", "like", $q)->orWhere("offres.description", "like", $q)->orWhere("characteristic", "like", $q);
                    ;
                });
            })->when(
                $request->filled("city"),
                function ($query) use ($request) {
                    $query->where("city", "=", $request->input("city"));
                }
            )->when(
                $request->filled("salary"),
                function ($query) use ($request) {
                    $query->where("salaire", ">", $request->input("salary"));
                })
                ->when(
                    $request->filled("contrat"),
                    function ($query) use ($request) {
                        $query->where("contrat", "=", $request->input("contrat"));
                    })
                    ->when(
                        $request->filled("domain"),
                        function ($query) use ($request) {
                            $query->where("domain", "=", $request->input("domain"));
                        })
                        ->
                    
                    latest()->get()
        ;

        return \Response::json($offres);
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
                "starting" => "date",
                "salary" => "numeric",
                "city" => "integer",
                "domain" => "integer",
                "contrat" => "integer",
            ]
        );
        $data = $request->post();
        $data["user_id"] = \Auth::id();
        if (Offres::create($data)) {
            return \Response::json(["message" => "offer added succesfuly"]);
        }
        ;

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
        $offre = Offres::findOrFail($id);
        if ($offre->user_id == \Auth::id()) {
            $offre->delete();
            return \Response::json(["message" => "success"]);
        }
    }
}
