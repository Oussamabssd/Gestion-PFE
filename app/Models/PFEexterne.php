<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFEexterne extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdP',
        'Organisme',
        'Titre',
        'Description',
        'Plan_du_travail',
        'IdEns1',
        'IdEns2',
        'IdEx',
        'est_Accepte',
        'est_Valide',
        'IdE',
    ];
}
