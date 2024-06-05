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
        $data = $request->validate(
            [
                "email" => "email|required",
                "n-entreprise" => "nullable|string|min:5|max:15",
                "name" => "nullable|string",
                "last-name" => "nullable|string",
                "first-name" => "nullable|string|min:5|max:15",
                "password" => "min:8|max:15|required",
                "type" => "required|numeric"
            ]
        );
        $data["password"] = bcrypt($data["password"]);
        $user = User::create($data);
        if ($request->post("type") == 2) {
            //entr
            Entreprise::create([
                "n-entreprise" => $data["n-entreprise"],
                "user_id" => $user->id,
                "name" => $data["name"]
            ]);
        } else {
            //user
            $Individuel = Individuel::create([
                "prenom" => $data["last-name"],
                "nom" => $data["first-name"],
                "user_id" => $user->id
            ]);
        }
        $token = $user->createToken('remember_token')->plainTextToken;
        return Response::json(["user" => $user, "token" => $token, "message" => "sign-up succesfully", "status" => 200]);
    }

    public function login(Request $request)
    {
        $values = ["email" => $request->post()["email"], "password" => $request->post()["password"]];
        if (Auth::attempt($values)) {
            $request->session()->regenerate();
            $type = User::find(Auth::id())->type;
            $id = $type == 2 ? Entreprise::where("entreprise.user_id", "=", Auth::id())->get()[0]->id
                : Individuel::where("individuel.user_id", "=", Auth::id())->get()[0]->id;
            return Response::json(["id" => $id, "type" => $type]);
        } else {
            return Response::json(["status" => 401, "message" => "sign-up failed"]);
        }
        ;
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
}
