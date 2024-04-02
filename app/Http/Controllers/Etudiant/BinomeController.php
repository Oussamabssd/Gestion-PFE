<?php

namespace App\Http\Controllers\Etudiant;

use App\Http\Controllers\Controller;
use App\Models\Binome;
use App\Models\Etudiant;
use App\Models\fetchbinome;
use Illuminate\Http\Request;

class BinomeController extends Controller
{
    function AjouterBinome(Request $request){
        try {

            $existbinome = Binome::where('IdB' , '=' , $request->input('IdB'))->first();

            if ($existbinome) {
                return response()->json([
                    "message" => "binome existe deja"
                ],401);
            }
            // ajouter un binome
            Binome::create([
                "IdB" => $request->input('IdB'),
                "Nom" => $request->input('Nom'),
                "Prenom" => $request->input('Prenom'),
                "Date_naissance" => $request->input('Date_naissance'),
                "Niveau" => $request->input('Niveau'),
                "Specialite" => $request->input('Specialite'),
                "Email" => $request->input('Email')
            ]);
            //associer le binome avec l'étudiant
            Etudiant::where('IdE', $request->input('IdE'))
            ->update([
                'IdB' => $request->input('IdB')
            ]);
            //supprimer le binome si il existe dans la liste des fetch binome
            fetchbinome::where('IdE' , '=' , $request->input('IdB'))->delete();
            return response()->json([
                "message" => "Binome ajouté avec success"
            ],201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
