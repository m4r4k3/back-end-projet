<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demandes extends Model
{
    use HasFactory;

    protected $table = 'demandes';

    protected $fillable = [
        'salaire',
        'location',
        'role',
        "domain",
        'id_user'
    ];
}
