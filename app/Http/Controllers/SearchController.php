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

        $demandes = Demandes::orderBy("created_at")
        ->select(
            "demandes.id",
            "demandes.salaire",
            "individuel.nom as nom",
            "individuel.prenom as prenom",
            "demandes.created_at",
            "demandes.id as user_id",
            "demandes.experience",
            "demandes.niveau",
            "demandes.description",
            "city.name as location",
            "role"
        )
        ->join("individuel", "individuel.user_id", "=", "demandes.user_id")
        ->join("city", "city.id", "=", "demandes.location")
        ->where(function ($query) use ($q) {
            $query->where("demandes.role", "like", $q)->orWhere("demandes.description", "like", $q);
        })
    ->limit(2)
        ;
    

        $offres = Offres::orderBy("created_at")->join("entreprise", "entreprise.user_id", "=", "offres.user_id")->select(
            "offres.id",
            "offres.salary",
            "entreprise.name",
            "domain.domain as domain",
            "city.name as city",
            "offres.description",
            "offres.created_at",
            "offres.starting",
            "contrat.type as contrat",
            "offres.characteristic",
            "post"
        )
        ->join("domain", "offres.domain", "=", "domain.id")
        ->join("city", "offres.city", "=", "city.id")
        ->join("contrat", "offres.contrat", "=", "contrat.id")->where(function ($query) use ($q) {
            $query->where("post", "like", $q)->orWhere("offres.description", "like", $q)->orWhere("characteristic", "like", $q);
            ;
        })->limit(2);

        $individuel = Individuel::where(function ($query) use ($q) {
            $query->where("nom", "like", $q)->orWhere("description", "like", $q)->orWhere("prenom", "like", $q);
        })
        ->limit(2);
        $entreprise = Entreprise::where(function ($query) use ($q) {
            $query->where("name", "like", $q)->orWhere("description", "like", $q);
        })->limit(2);

        $data = [
            "entreprises" => $entreprise->get(),
            "demandes" => $demandes->get(),
            "offres" => $offres->get(),
            "individuel" => $individuel->get()
        ];
        return \Response($data);
    }
}
