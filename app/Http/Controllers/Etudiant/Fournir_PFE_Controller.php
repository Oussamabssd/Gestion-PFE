<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Fournir_PFE_Controller extends Controller
{
    function FournirMemoire(Request $request){
        try {
            $Specialite = strtoupper($request->input('Specialite'));
            $Niveau = strtoupper($request->input('Niveau'));
            $IdE = strtoupper($request->input('IdE'));
            $IdB = strtoupper($request->input('IdB'));
            //generer le nom de fichier
            $nomPDF = 'memoire_'.$IdE.'_'.$IdB.'.pdf';
            //telecharger la memoire
            $request->file->storeAs("public/MemoirePFE/{$Niveau}/{$Specialite}/", $nomPDF);
            return response()->json([
                "message" => "PDF uploaded successfully",
                "memoire" => $nomPDF
            ] , 201);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
