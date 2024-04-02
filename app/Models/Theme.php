<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdT',
        'Titre',
        'Description',
        'Plan_du_travail',
        'Niveau',
        'IdEns'
    ];
}
