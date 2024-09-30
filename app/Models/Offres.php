<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offres extends Model
{
    use HasFactory;

    protected $table = 'offres';

    protected $fillable = [
        'domain_id',
        'post',
        'city',
        'user_id',
        'salary',
        'description',
        'characteristic',
        'type_contrat',
        'starting'
    ];
    // has
    public function  applicants(){
        return $this->hasMany(Applicant::class) ;
    }
    
    public function  city(){
        return $this->hasOne(City::class) ;
    }
    public function  contrat(){
        return $this->hasOne(Contrat::class) ;
    }
    public function  domain(){
        return $this->hasOne(Domain::class) ;
    }
    // belongs to
    public function user () {
        return $this->belongsTo(User::class) ;
    }

}
