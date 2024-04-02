<?php

namespace App\Services;

use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeIdGenerator
{
    public static function generateThemeId(Request $request){

        $Niveau = $request->input('Niveau');
        $Nom = $request->input('Nom');
        $Prenom = $request->input('Prenom');

        $IdNom = strtoupper(substr($Nom, 0, 1));
        $IdPrenom = strtoupper(substr($Prenom, 0, 1));
        $incrementalNumber = static::getNextIncrementalNumber();

        $themeId = $Niveau . $IdNom . $IdPrenom . '_' . $incrementalNumber;

        return $themeId;
    }

    protected static function getNextIncrementalNumber(){
        $counter = Theme::count();
        $counter++;

        return $counter;
    }
}
