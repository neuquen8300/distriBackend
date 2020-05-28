<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\BadResponseException;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){

        // Se valida el request. No es necesario un request propio siendo
        // que son 2 parametros nomas. 

        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        /* 
            Intentamos autenticar, si es válida la combinación [user, password], 
            traemos el usuario con su respectivo rol y le otorgamos un token.
            Caso contrario, 401.
        */
        if (Auth::attempt(['email' => $request->email, 'password' => $request['password']])){
            $user = Auth::user();
            $token = $user->createToken($user->email . '-' . now());

            return response()->json([
                'access_token' => $token->accessToken,
                'role' => $user->role_id
            ], 200);
        } else {
            return response('invalid request', 401);
        }
    }

    public function logout(Request $request){
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });
        return response()->json('Sesión cerrada correctamente.', 200);
    }
}
