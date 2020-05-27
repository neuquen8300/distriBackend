<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\BadResponseException;

class AuthController extends Controller
{
    public function login(Request $request){
        $http = new \GuzzleHttp\Client;

        try {
            $response = $http->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->username,
                    'password' => $request->password
                ]
            ]);
            return $response->getBody();
        } catch (BadResponseException $e){
            if ($e->getCode() === 400) {
                return response()->json('Request inválido. Ingresá usuario y contraseña.', $e->getCode());
            } else if ($e->getCode() === 401) {
                return response()->json('Las credenciales no son válidas, por favor intentá de nuevo.', $e->getCode());
            }

            return response()->json('Problemas técnicos, volvé a intentarlo en 5 minutos.', $e->getCode());
        }
    }
    public function logout(Request $request){
        auth()->user()->tokens->each(function($token, $key){
            $token->delete();
        });
        return response()->json('Sesión cerrada correctamente.', 200);
    }
}
