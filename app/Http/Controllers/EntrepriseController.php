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
            $entreprise = Entreprise::select(
                "*" , "city.name as city"
            )->where(function ($query) use ($q) {
                $query->where("entreprise.name", "like", $q)->orWhere("description", "like", $q);
            })->leftJoin("city" , "entreprise.location" ,"=","city.id");
    
        };
        if($request->has("location")){
            $city = $request->input("location");
            $entreprise = $entreprise->where("location", "=",$city);
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

        $data =       $request->validate([
                "description"=>"string" ,
                "location" =>"integer"
            ]);
    
        Entreprise::where("user_id" , "=" ,\Auth::id())->update($data);
    return $request ; 
    }else{
        return \Response::json(["status"=>\Auth::check()]);
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
