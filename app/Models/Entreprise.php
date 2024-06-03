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
}
