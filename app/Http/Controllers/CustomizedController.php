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
        return Response::json( Offres::where("user_id", "=",Auth::id())->get() );
    }
}
