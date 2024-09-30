<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
    use HasFactory;

    protected $table = 'domain';

    protected $fillable = [
        'domain'
    ];
    // belongs 

    public function  offres(){
        return $this->belongsToMany(Offres::class) ;
    }
    public function  entreprise(){
        return $this->belongsTo(Entreprise::class) ;
    }
 public function  Individuel(){
        return $this->belongsTo(Individuel::class) ;
    }

}
