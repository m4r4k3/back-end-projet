<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Individuel;
use App\Models\Skills;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Response;

class IndividuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $individuel = Individuel::with(["city"])->when(
            $request->filled("q") , 
            function ($query) use ($request) {
            $q = "%" . $request->input("q") . "%";
            $query->where(function ($query) use ($q) {
                $query->where("nom", "like", $q)->orWhere("description", "like", $q)->orWhere("prenom", "like", $q);
            });
            }
        )->when ( $request->has("city") , function ($query) use ($request) {
            $city = $request->input("city");
            $query->where("location", "=", $city);
        } )->orderBy("created_at");

        return \Response::json($individuel->get());
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
        $individuel = Individuel::with(["city" , "experience" ,"skill" , "education" ])->findOrFail($id);
        return Response::json($individuel) ;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $individuel = Individuel::with(["experience" ,"skill" , "education" ])->findOrFail(\Auth::id());
        return Response::json($individuel) ;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(rules: [
            "phone" => "numeric",
        ]);
        $data = $request->input();
        if (\Auth::check()) {
                Individuel::where("user_id", "=",  \Auth::id())->update($data);
                return \Response::json(["status" => 200]);
        } 
        return \Response::json(["status" =>401]);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
