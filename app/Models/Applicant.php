<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    use HasFactory;

    protected $table = 'postules';

    protected $fillable = [
        'offre_id',
        'user_id'
    ];
}
