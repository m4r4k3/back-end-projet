<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $table = 'entreprise';
    protected $fillable = [
        'name',
        'description',
        'location',
        'image',
        "n-entreprise",
        'user_id'
    ];
    // has
    public function domain(){
        return $this->hasOne(Domain::class,   "id" , "domain") ;
    }
    public function city(){
        return $this->hasOne(City::class , "id" , "location") ;
    }
    //belongs 
    public function  user(){
        return $this->belongsTo(User::class ) ;
    }
}
