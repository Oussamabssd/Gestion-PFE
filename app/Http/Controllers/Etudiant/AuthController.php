<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Etudiant;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function register(Request $request){
        try {
            // Vérifier si l'utilisateur existe déjà
            $existingEtudiant = Etudiant::where('IdE', $request->input("IdE"))->first();
            if ($existingEtudiant) {
                return response()->json(['message' => 'cette utilisateur existe deja'], 409);
            }
            // Créer un nouvel utilisateur
            Etudiant::create([
                "IdE" => $request->input("IdE"),
                "Nom" => $request->input("Nom"),
                "Prenom" => $request->input("Prenom"),
                "Date_naissance" => $request->input("Date_naissance"),
                "Niveau" => $request->input("Niveau"),
                "Specialite" => $request->input("Specialite"),
                "Email" => $request->input("Email"),
                "Password" => $request->input("Password"),
            ]);
            return response()->json([
                'message' => 'Utilisateur cree avec succes'
            ], 201);

        } catch (\Throwable $th) {

            return response()->json([
                'status'=> false,
                'message'=> $th->getMessage()
            ],500);
        }
    }

    function login(Request $request){
        try {
            //verifier l'existance d'utilisateur
            $Etudiant = Etudiant::where('IdE' , $request->input("IdE"))->first();
            if(!$Etudiant){
                return response()->json(["message" => "Etudiant not found"],401);
            }
            //verifier le mot de pass
            if ($Etudiant->password != $request->input("password")) {
                return response()->json(["message" => "wrong password"],401);
            }

            return response()->json([
                "message" => "login with success",
                "IdE" => $Etudiant->IdE
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function ModifierEtudiant(Request $request){
        try {

            Etudiant::where("IdE" , '=' , $request->input("IdE"))
            ->update([
                "IdE" => $request->input("IdE"),
                "Nom" => $request->input("Nom"),
                "Prenom" => $request->input("Prenom"),
                "Date_naissance" => $request->input("Date_naissance"),
                "Niveau" => $request->input("Niveau"),
                "Specialite" => $request->input("Specialite"),
                "Email" => $request->input("Email"),
                "Password" => $request->input("Password"),
            ]);
            return response()->json([
                "message" => "Etudiant modifié avec success"
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
