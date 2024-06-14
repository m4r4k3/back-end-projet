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

        $offres = Offres::join("entreprise", "entreprise.user_id", "=", "offres.user_id")->select(
            "offres.id as id",
            "offres.salary",
            "entreprise.name",
            "domain.domain as domain",
            "city.name as city",
            "offres.description",
            "offres.created_at",
            "offres.starting",
            "contrat.type as contrat",
            "offres.characteristic",
            "post",

        )
            ->join("domain", "offres.domain_id", "=", "domain.id")
            ->join("city", "offres.city", "=", "city.id")
            ->join("contrat", "offres.type_contrat", "=", "contrat.id");
        if (\Auth::check() && User::find(\Auth::id())->type == 1) {
            $offres->leftjoin('applicants', function ($join) {
                $join->on('offres.id', '=', 'applicants.offre_id')
                    ->where('applicants.user_id', '=', \Auth::id());
            })->addSelect(DB::raw("if(applicants.user_id,true,false) as isApplied"))->groupBy("offres.id")
            ;
        }
        if ($request->input("q")) {
            $q = "%" . $request->input("q") . "%";
            $offres = $offres->where(function ($query) use ($q) {
                $query->where("post", "like", $q)->orWhere("offres.description", "like", $q)->orWhere("characteristic", "like", $q);
                ;
            });
        }
        ;
        if ($request->input("city")) {
            $city = $request->input("city");
            $offres = $offres->where("offres.city", "=", $city);
        }
        ;
        if ($request->input("salary")) {
            $salary = $request->input("salary");
            $offres = $offres->where("offres.salary", ">", 0);
        }
        ;

        if ($request->input("type_contrat")) {
            $type_contrat = $request->input("type_contrat");
            $offres = $offres->where("type_contrat", "=", $type_contrat);
        }
        ;

        $offres = $offres->orderBy("created_at")->limit(30)->get();
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
                "domain_id" => "integer",
                "contrat" => "integer",
            ]
        );
        try {
            $data = $request->post();
            $data["user_id"] = \Auth::id();
            if (Offres::create($data)) {
                return \Response::json(["message" => "offer added succesfuly"]);
            }
            ;
        } catch (\Exception $e) {
            return \Response::json(["status" => 404, "message" => $e->getMessage()]);
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
            Offres::find($id)->delete();
            return \Response::json(["message" => "success"]);
        }
    }
}
