<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enseignant;
use Illuminate\Http\Request;

class GererEnseignantController extends Controller
{
    function AjouterEnseignant (Request $request){
        try {
            // Vérifier si l'enseignant existe déjà
            $existingens = Enseignant::where("IdEns" , $request->input("IdEns"))->first();
            if ($existingens) {
                return response()->json(['message' => 'cette Enseignant existe deja'], 409);
            }
            // Créer un nouvel utilisateur
            Enseignant::create([
                "IdEns" => $request->input("IdEns"),
                "Nom" => $request->input("Nom"),
                "Prenom" => $request->input("Prenom"),
                "Grade" => $request->input("Grade"),
                "Email" => $request->input("Email"),
                "Password" => $request->input("Password")
            ]);
            return response()->json([
                'message' => 'Enseignant cree avec succes'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function GetAllEnseignant(){
        try {

            $AllEns = Enseignant::all();
            return $AllEns;

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
