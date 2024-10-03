<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $table = 'skill';

    protected $fillable = [
        'title',
        'user_id'
    ];
    public function  user(){
        return $this->belongsTo(Individuel::class) ;
    }
}
