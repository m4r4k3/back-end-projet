<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;

class ExperienceController extends Controller
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
        $data = $request->post();
        $exp = Experience::insert([
            "entr"=>$data["entreprise"],
            "post"=>$data["post"],
            "start"=>$data["start"],
            "end"=>$data["end"],
            "user_id"=>$request->user()->id,
            "description"=>$data["description"]
        ]);
        return $exp ;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function destroy(string $id ,Request $request)
    {
       $exp = Experience::find($id);

        if($exp->user_id == $request->user()->id){
            $exp->delete();
        }else{
            return \Response::json(["status"=>401]);
        };

        return \Response::json(["status"=>200]) ;
    }
}
