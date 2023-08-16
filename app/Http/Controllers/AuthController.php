<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function funIngresar(Request $request){
        $credenciales = $request->validate([
            "email" => "required|email",
            "password" => "required"
        ]);

        if(!Auth::attempt($credenciales)){
            return response()->json(["message" => "Credenciales Incorrectas"], 401);
        }
        $usuario = Auth::user();
        $token = $usuario->createToken("token Personal")->plainTextToken;
        
        return response()->json(["access_token" => $token, "usuario" => $usuario ], 201);

    }
    public function funRegistro(Request $request){

        $request->validate([
            "name"=> "required",
            "email" => "required|email|unique:users",
            "password" => "required",
            "password2" => "required|same:password"
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        return response()->json(["message" => "Usuario Registrado"]);
        
    }
    public function funPerfil(){
        $usuario = Auth::user();
        return response()->json($usuario, 200);
        
    }
    public function funSalir(){
        Auth::user()->tokens()->delete();

        return response()->json(["message" => "Salio"], 200);        
    }
}
