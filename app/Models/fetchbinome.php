<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fetchbinome extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdE',
        'Nom',
        'Prenom',
        'Date_naissance',
        'Niveau',
        'Specialite',
        'Email'
    ];
}
