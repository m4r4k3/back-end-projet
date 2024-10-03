<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'applicants';
    protected $fillable = [
        'offre_id',
        'user_id'
    ];
    public function offre() {
        return $this->belongsTo(Offres::class);
    }
    public function user(){
        return $this->hasOne(User::class) ; 
    }
}
