<?php

namespace App\Http\Controllers;

use App\Models\Demandes;
use App\Models\Entreprise;
use App\Models\Individuel;
use App\Models\Offres;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function teaser(Request $request)
    {
        $q = "%" . $request->input("q") . "%";

        $demandes = Demandes::orderBy("created_at")->where(function ($query) use ($q) {
            $query->where("role", "like", $q)->orWhere("description", "like", $q);
        });

        $offres = Offres::orderBy("created_at")->where(function ($query) use ($q) {
            $query->where("post", "like", $q)->orWhere("description", "like", $q)->orWhere("characteristic", "like", $q);
            ;
        });

        $individuel = Individuel::where(function ($query) use ($q) {
            $query->where("nom", "like", $q)->orWhere("description", "like", $q)->orWhere("prenom", "like", $q);
        });
        $entreprise = Entreprise::where(function ($query) use ($q) {
            $query->where("name", "like", $q)->orWhere("description", "like", $q);
        });

        $data = [
            "entreprises" => $entreprise->get(),
            "demandes" => $demandes->get(),
            "offres" => $offres->get(),
            "individuel" => $individuel->get()
        ];
        return \Response($data);
    }
}
