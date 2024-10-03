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


        $individuel = Individuel::orderBy("created_at")->with(["city"]);
        if ($request->has("q")) {
            $q = "%" . $request->input("q") . "%";
            $individuel = $individuel->where(function ($query) use ($q) {
                $query->where("nom", "like", $q)->orWhere("description", "like", $q)->orWhere("prenom", "like", $q);
            });
        }
        ;
        if ($request->has("city")) {
            $city = $request->input("city");
            $individuel = $individuel->where("location", "=", $city);
        }
        ;
        return \Response::json($individuel->limit(30)->get());
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
        } else {
            return \Response::json(["status" => \Auth::check()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
