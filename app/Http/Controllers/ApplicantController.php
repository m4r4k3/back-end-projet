<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\Individuel;
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
        $data = $request->post();
        $data["user_id"] = \Auth::id();
        
        
        $isExists = Applicant::where("user_id", "=", $data["user_id"])
                ->where("offre_id", "=", $data["offre_id"])
      ->exists();

        if (!$isExists) {
            Applicant::insert([$data]);
        } else {
            return \Response::json(["message" => "Unauthorized"], 403);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)

    {
        $id = \Auth::id() ;

        if (\Auth::check()) {
            $applicant = Applicant::where("offre_id", "=", $id)
                    ->with(["offres"=>function ($query) use($id) {
                        $query->where("user_id" , "=" ,$id) ;
                    }, "individuel"]);
            return $applicant->get() ;  
        }
        return \Response::json(["message" => "unauthorized"], 401);
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
