<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $table = 'experience';

    protected $fillable = [
        'ent_id',
        'post',
        'start',
        'end',
        'user_id'
    ];
    public function  user(){
        return $this->belongsTo(User::class) ;
    }
}
