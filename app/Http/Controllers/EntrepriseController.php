<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;
use Response;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $entreprise = Entreprise::when($request->filled("q"), function ($query) use ($request) {
            $q = "%" . $request->input("q") . "%";
            $query->where(function ($sub) use ($q) {
                $sub->where("entreprise.name", "like", $q)->orWhere("description", "like", $q);
            });
        })->when($request->filled("location"), function ($query) use ($request) {
            $city = $request->input("location");
            $query->where("location", "=", $city);
        })->latest()->with(["city" => function ($query) {
            $query->select("id", "name as city") ;
        }]);

        return \Response::json($entreprise->get());
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
        $entreprise = Entreprise::with(["city" , "domain"])->findOrFail($id);
        return \Response::json($entreprise);
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
        if (\Auth::check()) {

            $data = $request->validate([
                "description" => "string",
                "location" => "integer"
            ]);

            Entreprise::where("user_id", "=", \Auth::id())->update($data);
        } else {
            return \Response::json(["status" =>401]);
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
