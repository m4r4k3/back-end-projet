<?php

namespace App\Http\Controllers;

use App\Models\Skills;
use Illuminate\Http\Request;

class SkillController extends Controller
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
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Skills::insert(["title"=>$request->post("title") , "user_id"=>$request->user()->id]) ;
        //
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
        $skill = Skills::find($id);

        if($skill->user_id == $request->user()->id){
            $skill->delete();
        }else{
            return \Response::json(["status"=>401]);
        };

        return \Response::json(["status"=>200]) ;
    }
}
