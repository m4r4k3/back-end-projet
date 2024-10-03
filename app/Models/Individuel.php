<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Individuel extends Model
{
    use HasFactory;

    protected $table = 'individuel';

    protected $fillable = [
        'time',
        'domain',
        'image',
        'city',
        'nom',
        'phone',
        'prenom',
        "user_id",
        'description'
    ];
    // has
    public function domain(){
        return $this->hasOne(Domain::class , "id" , "domain") ;
    }
    public function city(){
        return $this->hasOne(City::class , "id" , "city") ;
    }
    public function experience(){
        return $this->hasMany(Experience::class  , "user_id"  , "user_id" ) ;
    }
    public function skill(){
        return $this->hasMany(Skills::class  , "user_id"  , "user_id" ) ;
    }
    public function education(){
        return $this->hasMany(Education::class  , "user"  , "user_id" ) ;
    }
    //belongs 
    public function  user(){
        return $this->belongsTo(User::class ) ;
    }
}
