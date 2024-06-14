<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Models\Individuel;
use App\Models\User;
use Illuminate\Http\Request;
use Response;
use Auth;

class LoginSignupController extends Controller
{
    public function signup(Request $request)
    {
        if ($request->post("type") == 2) {
            $data = $request->validate(
                [
                    "email" => "email|required|unique:users,email",
                    "n-entreprise" => "string|min:5|max:15|unique:entreprise,n-entreprise",
                    "name" => "string|unique:entreprise",
                    "password" => "min:8|max:15|required",
                    "type" => "required|numeric"
                ]
            );
            $data["password"] = bcrypt($data["password"]);
            $user = User::create($data);
            //entr
            $entreprise = Entreprise::create([
                "n-entreprise" => $data["n-entreprise"],
                "user_id" => $user->id,
                "name" => $data["name"]
            ]);
            $token = $user->createToken('remember_token')->plainTextToken;
            Auth::login($user);
            return Response::json(["id" => $entreprise->id , "type"=>$user->type, "token" => $token, "message" => "sign-up succesfully", "status" => 200]);
        } else {
            //user
            $data = $request->validate(
                [
                    "email" => "email|required|unique:users,email",
                    "last-name" => "string",
                    "first-name" => "string",
                    "password" => "min:8|max:15|required",
                    "type" => "required|numeric"
                ]
            );
            $data["password"] = bcrypt($data["password"]);
            $user = User::create($data);
            $Individuel = Individuel::create([
                "prenom" => $data["last-name"],
                "nom" => $data["first-name"],
                "user_id" => $user->id
            ]);
            $token = $user->createToken('remember_token')->plainTextToken;
            Auth::login($user);
            return Response::json(["id" => $Individuel->id , "type"=>$user->type, "token" => $token, "message" => "sign-up succesfully", "status" => 200]);
        }

    }

    public function login(Request $request)
    {
        $values = $request->post();
        if (Auth::attempt($values)) {
            $request->session()->regenerate();
            $type = User::find(Auth::id())->type;
            $id = $type == 2 ? Entreprise::where("entreprise.user_id", "=", Auth::id())->get()[0]->id
                : Individuel::where("individuel.user_id", "=", Auth::id())->get()[0]->id;
            return Response::json(["id" => $id, "type" => $type]);
        }
        return Response::json([
            "message" => "Unauthenticated."
        ], 401);
    }
    public function islogged(Request $request)
    {
        if (!Auth::check()) {
            return Response::json(["loggedIn" => false, "id" => null, "type" => null]);
        }
        $type = Auth::check() ? $request->user()->type : null;
        $id = $type == 2 ? Entreprise::where("entreprise.user_id", "=", Auth::id())->get()[0]["id"] : Individuel::where("individuel.user_id", "=", Auth::id())->get()[0]["id"];
        return Response::json(["loggedIn" => Auth::check(), "id" => $id, "type" => $type]);
    }
    public function logout()
    {
        \Session::flush();
        Auth::logout();
    }
}
