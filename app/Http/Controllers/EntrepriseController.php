<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use Illuminate\Http\Request;

class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $entreprise = Entreprise::orderBy("created_at");
        if($request->has("q")){
            $q="%".$request->input("q")."%";
            $entreprise = Entreprise::where(function ($query) use ($q) {
                $query->where("name", "like", $q)->orWhere("description", "like", $q);
            });
    
        };
        if($request->has("city")){
            $city = $request->input("city");
            $entreprise = $entreprise->where("city", "=",$city);
        };
        return \Response::json($entreprise->limit(30)->get());
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
        
        $entreprise = Entreprise::where("entreprise.id", "=" , $id)->get();
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
        if(\Auth::check()){

            $request->validate([
                "description"=>"string"
            ]);
        Entreprise::where("user_id" , "=" ,\Auth::id())->update(["description"=>$request->input("description")]);
    return $request ; 
    }else{
        return \Response::json(["status"=>404]);
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
