<?php

namespace App\Services;

use App\Models\PFEinterne;
use Illuminate\Http\Request;

class PfeIdGenerator
{
    public static function generatePFEinterneId(Request $request){
        $Specialite = $request->input('$Specialite');
        $IdT = $request->input('$IdT');

        $IdSpecialite = strtoupper($Specialite);
        $IdIdT = strtoupper($IdT);
        $incrementalNumber = static::getNextIncrementalNumber();

        $PFEinId = $IdSpecialite . $IdIdT . '_' . $incrementalNumber;

        return $PFEinId;
    }



    protected static function getNextIncrementalNumber(){
        $counter = PFEinterne::count();
        $counter++;

        return $counter;
    }
}
