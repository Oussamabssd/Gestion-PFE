<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\PFEinterne;
use Illuminate\Http\Request;

class GererDemandeController extends Controller
{
    function GetAllDemandes (Request $request){
        try {

        $result = PFEInterne::select('p_f_einternes.IdP', 'etudiants.Nom', 'etudiants.Prenom', 'etudiants.Specialite', 'etudiants.Niveau', 'binomes.Nom as BinomeNom', 'binomes.Prenom as BinomePrenom', 'themes.IdT', 'themes.Titre')
        ->join('themes', 'p_f_einternes.IdT', '=', 'themes.IdT')
        ->join('enseignants', 'themes.IdEns', '=', 'enseignants.IdEns')
        ->join('etudiants', 'p_f_einternes.IdE', '=', 'etudiants.IdE')
        ->join('binomes', 'etudiants.IdB', '=', 'binomes.IdB')
        ->where('enseignants.IdEns', $request->input('IdEns'))
        ->get();

        return $result;

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function AccepterDemande (Request $request){
        try {

           PFEinterne::where('IdP' , '=' , $request->input('IdP'))
           ->update([
            "est_Accepte" => "accepte"
           ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function RefuserDemande (Request $request){
        try {

           PFEinterne::where('IdP' , '=' , $request->input('IdP'))
           ->update([
            "est_Accepte" => "refuse"
           ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function ValiderPFE (Request $request){
        try {

           PFEinterne::where('IdP' , '=' , $request->input('IdP'))
           ->update([
            "est_Valide" => "valide"
           ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function RejouterPFE (Request $request){
        try {

           PFEinterne::where('IdP' , '=' , $request->input('IdP'))
           ->update([
            "est_Valide" => "rejoute"
           ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
