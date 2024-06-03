<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;

class EducationController extends Controller
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
        $exp = Education::insert([
            "school"=>$data["school"],
            "certificate"=>$data["certificate"],
            "start"=>$data["start"],
            "end"=>$data["end"],
            "user"=>$request->user()->id,
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
        $education = Education::find($id);

        if($education->user == $request->user()->id){
            $education->delete();
        }else{
            return \Response::json(["status"=>401]);
        };

        return \Response::json(["status"=>200]) ;
    }
}
