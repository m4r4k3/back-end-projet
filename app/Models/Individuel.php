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
}
