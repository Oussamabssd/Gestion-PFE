<?php

namespace App\Http\Controllers\Enseignant;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request){
        try {
            //verifier l'existance d'utilisateur
            $Enseignant = Enseignant::where('IdEns' , $request->input("IdEns"))->first();
            if(!$Enseignant){
                return response()->json(["message" => "Enseignant not found"],404);
            }
            //verifier le mot de pass
            if ($Enseignant->password != $request->input("password")) {
                return response()->json(["message" => "wrong password"],401);
            }

            return response()->json([
                "message" => "login with success",
                "IdEns" => $Enseignant->IdEns
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function ModifierEnseignant(Request $request){
        try {
            Enseignant::where('IdEns' , '=' , $request->input("IdEns"))
        ->update([
            "IdEns" => $request->input("IdEns"),
            "Nom" => $request->input("Nom"),
            "Prenom" => $request->input("Prenom"),
            "Grade" => $request->input("Grade"),
            "Email" => $request->input("Email"),
            "Password" => $request->input("Password")
        ]);
        return response()->json([
            "message" => "Enseignant modifié avec success"
        ],200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
