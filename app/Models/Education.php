<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'education';

    protected $fillable = [
        'school',
        'certificate',
        'start',
        'end',
        'description',
        'user'
    ];
    public function  user(){
        return $this->belongsTo(User::class) ;
    }
}
