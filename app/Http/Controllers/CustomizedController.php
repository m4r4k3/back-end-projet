<?php

namespace App\Http\Controllers;

use App\Models\Demandes;
use App\Models\Offres;
use Illuminate\Http\Request;
use \Auth ;
use Response ;

class CustomizedController extends Controller
{
    public function MyDemandes() {
        
        return Response::json( Demandes::where("user_id", "=",Auth::id())->get() );
    }
    public function MyOffres() {
        $data = Offres::where("offres.user_id", "=",Auth::id())->select(
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
        )->join("entreprise", "entreprise.user_id", "=", "offres.user_id")
        ->join("domain", "offres.domain_id", "=", "domain.id")
        ->join("city", "offres.city", "=", "city.id")
        ->join("contrat", "offres.type_contrat", "=", "contrat.id") ->get();

        return Response::json( $data );
    }
}
