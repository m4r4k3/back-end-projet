<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandes extends Model
{
    use HasFactory;

    protected $table = 'demandes';

    protected $fillable = [
        'salaire',
        'location',
        'role',
        "domain",
        'id_user'
    ];
     // belongs 

     public function  user(){
        return $this->belongsTo(User::class) ;
    }
    
    public function individuel(){
        return $this->belongsTo(Individuel::class , "user_id" ,"user_id") ;
    }
    // has
    public function domain () {
        return $this->hasOne(Domain::class , "id" , "domain") ;
    }
    public function city(){
        return $this->hasOne(City::class , "id" , "location") ;
    }
}
