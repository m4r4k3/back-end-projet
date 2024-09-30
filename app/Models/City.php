<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    public $table ="city" ;
    public $fillable = ["name"];

     // belongs 

     public function  offres(){
        return $this->belongsToMany(Offres::class) ;
    }
    
    public function  demandes(){
        return $this->belongsToMany(Demandes::class) ;
    }
    public function  entreprise(){
        return $this->belongsTo(Entreprise::class) ;
    }
    public function  Individuel(){
        return $this->belongsTo(Individuel::class) ;
    }
}
