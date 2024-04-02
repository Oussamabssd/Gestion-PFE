<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Binome extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdB',
        'Nom',
        'Prenom',
        'Date_naissance',
        'Niveau',
        'Specialite',
        'Email'
    ];

}
