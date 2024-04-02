<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Services\ThemeIdGenerator;

class GererThemeController extends Controller
{
    function AjouterTheme(Request $request){
        try {
            //verifier si le theme existe deja
            $ExisteTheme = Theme::where('IdEns', '=', $request->input('IdEns'))
            ->where('Titre', '=', $request->input('Titre'))
            ->first();
            // si le theme n'existe pas ajouter dans la BD
            if($ExisteTheme){

               return response()->json([
                "message" => "cette theme existe deja"
               ],400);

            }else{

                Theme::create([
                    "IdEns" => $request->input('IdEns'),
                    "IdT" => ThemeIdGenerator::generateThemeId($request),
                    "Titre" => $request->input('Titre'),
                    "Description" => $request->input('Description'),
                    "Niveau" => $request->input('Niveau'),
                    "Plan_du_travail" => $request->input('Plan_du_travail')
                ]);
                return response()->json([
                    "message" => "theme ajouté avec success"
                   ],201);
            }

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }

    function ModifierTheme(Request $request){
        try {

            Theme::where('IdT' ,'=' ,$request->input('IdT'))
            ->update([
                "IdEns" => $request->input('IdEns'),
                "IdT" => $request->input('IdT'),
                "Titre" => $request->input('Titre'),
                "Description" => $request->input('Description'),
                "Niveau" => $request->input('Niveau'),
                "Plan_du_travail" => $request->input('Plan_du_travail')
            ]);

            return response()->json([
                "message" => "Theme modifié avec success"
            ],200);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }

    function SupprimerTheme(Request $request){
        try {
            $Theme = Theme::where('IdT' ,'=' ,$request->input('IdT'))->delete();

            return response()->json([
                "message" => "theme supprimé"
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }

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
}
