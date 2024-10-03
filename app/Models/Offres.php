<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    use HasFactory;

    protected $table = 'offres';

    protected $fillable = [
        'domain',
        'post',
        'city',
        'user_id',
        'salary',
        'description',
        'characteristic',
        'contrat',
        'starting'
    ];
    // has
    public function  applicants(){
        return $this->hasMany(Applicant::class , "offre_id" , "id")  ;
    }
    public function domain () {
        return $this->hasOne(Domain::class , "id" , "domain") ;
    }
    public function city(){
        return $this->hasOne(City::class , "id" , "city") ;
    }
    public function  contrat(){
        return $this->hasOne(Contrat::class , "id" , "contrat") ;
    }
    // belongs to
    public function user () {
        return $this->belongsTo(User::class) ;
    }
    public function entreprise () {
        return $this->belongsTo(Entreprise::class , "user_id" ,"user_id") ;
    }

}
