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
}
