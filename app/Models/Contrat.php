<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrat extends Model
{
    use HasFactory;
    public $table = "contrat" ;
    public $fillable = ["type"];
    public function  offres(){
        return $this->belongsToMany(Offres::class) ;
    }
}
