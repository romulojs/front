<?php

namespace App\Http\Request;

use App\Http\Request\Interfaces\ILoginRequest;

use Illuminate\Support\Facades\Http;

class LoginRequest implements ILoginRequest{
    
    public function LogarUsuario($login, $senha){
        $response = Http::post(env('API_URL') + "/authenticate", [
            "username" => $login,
            "password" => $senha
        ]);

        return $response;
    }

}