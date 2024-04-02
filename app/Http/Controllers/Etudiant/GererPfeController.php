<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Encadrant_externe;
use App\Models\Enseignant;
use App\Models\PFEexterne;
use App\Models\PFEinterne;
use App\Models\Theme;
use App\Services\PfeIdGenerator;
use Illuminate\Http\Request;

class GererPfeController extends Controller
{
    function GetAllEnsThemes(Request $request){
        try {

            $Themes = Theme::All()->where('IdEns' , '=' , $request->input('IdEns'));
            return $Themes;

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function GetAllThemes(){
        try {
            $AllThemes = Theme::all();
            return $AllThemes;

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function ChercherTheme(Request $request){
        try {

            $input = $request->input('Titre');
            $Themes = Theme::All()->where("Titre" , "Like" , "%$input%");
            return $Themes;

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function CherecherEnseignant(Request $request){
        try {
            $enseignants = Enseignant::select('nom', 'prenom')
            ->where('nom', $request->input('Nom'))
            ->orWhere('prenom', $request->input('Nom'))
            ->get();

            return $enseignants;

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function EnvoyerDemandeEncadrement (Request $request){
        try {
            //verifier s'il existe deja une demande d'encadrement
            $IdE = PFEinterne::where('IdE' , '=' , $request->input('IdE'));
            if ($IdE) {
                return response()->json(["message" => "vous avez fait deja une demande "],401);
            }
            $IdP = PfeIdGenerator::generatePFEinterneId($request);
            if ($IdP) {
                return response()->json(["message" => "cette PFE existe déja"],401);
            }
            //fait une demande
            PFEinterne::create([
                "IdP" => $IdP,
                "IdE" => $request->input('IdE'),
                "IdT" => $request->input('IdT')
            ]);
            return response()->json([
                "message" => "PFE interne ajouté avec success"
            ],201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function ProposerPFEexterne(Request $request){
        try {
            //verifier s'il existe deja une demande d'encadrement
            $IdE = PFEexterne::where('IdE' , '=' , $request->input('IdE'));
            if ($IdE) {
                return response()->json(["message" => "vous avez fait deja une demande "],401);
            }
            $IdP = PfeIdGenerator::generatePFEinterneId($request);
            if ($IdP) {
                return response()->json(["message" => "cette PFE existe déja"],401);
            }
            //fait une demande
            PFEexterne::create([
                'IdP' => $IdP,
                'Organisme' => $request->input("Organisme"),
                'Titre' => $request->input("Titre"),
                'Description' => $request->input("Description"),
                'Plan_du_travail' => $request->input("Plan_du_travail"),
                'IdE' => $request->input("IdE"),
                'IdEx
                //ajouter encad' => $request->input("IdEx"),
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function AssocierEncadrantExterne(Request $request){
        try {
            Encadrant_externe::create([
                'IdEx' => $request->input("IdEx"),
                'Nom' => $request->input("Nom"),
                'Prenom' => $request->input("Prenom"),
                'Email' => $request->input("Email"),
            ]);
            //associer un encadrant externe
            PFEexterne::where('IdP' , '=' , $request->input("IdP"))
            ->update([
                'IdEx' => $request->input('IdEx')
            ]);
            return response()->json([
                "message" => "encadrant externe ajouté avec success"
            ],201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
