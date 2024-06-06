<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use Illuminate\Http\Request;

class ApplicantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    if(\Auth::check()){
        $data = $request->post() ;
        $data["user_id"]=Individuel::where("user_id" , "=" , \Auth::id())->get[0]->id ;
        Applicant::insert($data);
       return ;
    }else{
        return \Response::json(["status"=>404]);
    }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $applicant = Applicant::where("offre_id")->join("postules", "postules.location = user.id")->join("image", "user.image = image.id");
        return \Response::json($applicant);
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
        //
    }
}
