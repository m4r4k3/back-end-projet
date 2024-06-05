<?php

namespace App\Http\Controllers;

use App\Models\Education;
use App\Models\Experience;
use App\Models\Individuel;
use App\Models\Skills;
use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;

class IndividuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
           
   
        $individuel = Individuel::orderBy("created_at");
        if($request->has("q")){
            $q="%".$request->input("q")."%";
            $individuel = $individuel->where(function ($query ) use ($q){
                $query->where("nom", "like" , $q)->orWhere("description" , "like",$q)->orWhere("prenom" , "like",$q);
            });
        };
        if($request->has("city")){
            $city = $request->input("city");
            $individuel = $individuel->where("location", "=",$city);
        };
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
        $individuel = Individuel::find( $id );
        $experience = Experience::where("user_id","=", $individuel->user_id )->get();
        $skill = Skills::where("user_id","=",$individuel->user_id )->get();
        $education = Education::where("user","=", $individuel->user_id  )->get();
        $email = User::find($individuel->user_id )->email ;

        return \Response::json(["ind"=>$individuel , "experience"=>$experience , "skill" =>$skill , "education"=>$education ,"email"=> $email]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $id = $request->user()->id;
        $individuel = Individuel::where("user_id","=", $id )->get();
        $experience = Experience::where("user_id","=", $id )->get();
        $skill = Skills::where("user_id","=", $id )->get();
        $education = Education::where("user","=", $id )->get();
        
        return \Response::json(["ind"=>$individuel , "experience"=>$experience , "skill" =>$skill , "education"=>$education ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            "phone"=>"numeric",
        ]);
        $data = $request->input();
        return \Response::json(["data"=>$request->input("description")]);
        if($id != \Auth::id()){
        return \Response::json(["status"=>403 , "message"=>"user unautorized"]);
        }
        if($request->has("image")){
            $image = $request->file("image")->store("individuel", "public");
            $image = Image::create(["path"=>$image]);
            return $image ;
        }
            $id = \Auth::id() ;
            Individuel::where("user_id", "=" ,$id)->update($data);

        return \Response::json(["status"=>200]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
