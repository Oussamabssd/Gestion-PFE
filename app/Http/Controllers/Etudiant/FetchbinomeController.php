<?php

namespace App\Http\Controllers\Etudiant;

use App\Models\fetchbinome;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class FetchbinomeController extends Controller
{
    function AjouterFetchBinome(Request $request){
        try {

            $existbinome = fetchbinome::where('IdE' , '=' , $request->input('IdE'))->first();

            if ($existbinome) {
                return response()->json([
                    "message" => "Etudiant existe deja"
                ],401);
            }

            fetchbinome::create([
                "IdE" => $request->input('IdE'),
                "Nom" => $request->input('Nom'),
                "Prenom" => $request->input('Prenom'),
                "Date_naissance" => $request->input('Date_naissance'),
                "Niveau" => $request->input('Niveau'),
                "Specialite" => $request->input('Specialite'),
                "Email" => $request->input('Email')
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }

    function ModifierFetchBinome(Request $request){
        try {

            fetchbinome::where('IdE',  $request->input('IdE'))
            ->update([
                "IdE" => $request->input('IdE'),
                "Nom" => $request->input('Nom'),
                "Prenom" => $request->input('Prenom'),
                "Date_naissance" => $request->input('Date_naissance'),
                "Niveau" => $request->input('Niveau'),
                "Specialite" => $request->input('Specialite'),
                "Email" => $request->input('Email')
            ]);
            return response()->json([
                "message" => "Binome modifié avec success"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function SupprimerFetchBinome(Request $request){

        try {

            fetchbinome::where('IdE' , '=' , $request->input('IdE'))->delete();

            return response()->json([
                "message" => "Binome supprimé avec success"
            ],200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function GetAllFetchBinome(){
        try {
            $Listfetchbinome = fetchbinome::all();
            return $Listfetchbinome;

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
