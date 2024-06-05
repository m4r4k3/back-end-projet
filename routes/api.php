<?php

use App\Http\Controllers\CityController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\LoginSignupController;
use App\Http\Controllers\SkillController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemandesController;
use App\Http\Controllers\EntrepriseController;
use App\Http\Controllers\IndividuelController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\SearchController; 
use App\Http\Controllers\ContratController; 
use App\Http\Controllers\DomainController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
    "demandes" => DemandesController::class,
    "education" => EducationController::class,
    "experience"=>ExperienceController::class ,
    "entreprise" => EntrepriseController::class,
    "individuel" => IndividuelController::class,
    "skill" => SkillController::class,
    "city" => CityController::class,
    "contrat" => ContratController::class,
    "domain" => DomainController::class,
    "offres" => OffreController::class,
    "applicant" => ApplicantController::class
]);

Route::get("/search", [SearchController::class , "teaser"]) ;
Route::post("/signup", [LoginSignupController::class , "signup"]) ;
Route::post("/login", [LoginSignupController::class , "login"]) ;
Route::get("/islogged", [LoginSignupController::class , "islogged"]) ;