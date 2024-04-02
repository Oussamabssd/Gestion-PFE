<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    function login(Request $request){
        try {
            //verifier l'existance d'Admin
            $Admin = Admin::where('IdA' , $request->input("IdA"))->first();
            if(!$Admin){
                return response()->json(["message" => "Admin not found"],404);
            }
            //verifier le mot de pass
            if ($Admin->password != $request->input("password")) {
                return response()->json(["message" => "wrong password"],401);
            }

            return response()->json([
                "message" => "login with success",
                "IdA" => $Admin->IdA
            ],200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ],500);
        }
    }
}
