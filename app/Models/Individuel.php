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
        return $this->hasOne(Domain::class) ;
    }
    public function city(){
        return $this->hasOne(City::class) ;
    }
    //belongs 
    public function  user(){
        return $this->belongsTo(User::class) ;
    }
}
