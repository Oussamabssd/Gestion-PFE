<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Encadrant_externe extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdEx',
        'Nom',
        'Prenom',
        'Email',
    ];
}
