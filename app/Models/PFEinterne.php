<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PFEinterne extends Model
{
    use HasFactory;

    protected $fillable = [
        'IdP',
        'est_Accepte',
        'est_Valide',
        'IdE',
        'IdT'
    ];
}
