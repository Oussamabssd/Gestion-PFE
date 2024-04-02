<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\session;
use Illuminate\Http\Request;

class GererSessionController extends Controller
{
    function OuvrirSession(Request $request){
        try {

            session::where('Nom' , '=' , $request->input("Nom"))
            ->update([
                'status' => "ouvert"
            ]);
            return response()->json([
                'message' => 'session ouvert avec succes'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function FermerSession(Request $request){
        try {

            session::where('Nom' , '=' , $request->input("Nom"))
            ->update([
                'status' => "ferme"
            ]);
            return response()->json([
                'message' => 'session ferme avec succes'
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
    function VerifierSession(Request $request){
        try {
            $test = session::select('Nom' , 'status')
            ->where('Nom' , $request->input("Nom"))
            ->get();
            return response()->json($test);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
