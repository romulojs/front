<?php

namespace App\Services;

use App\Services\Interfaces\ILoginService;

use App\Http\Request\LoginRequest;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class LoginService implements ILoginService{

    private $_loginRequest;

    public function __construct(LoginRequest $loginRequest){
        $this->_loginRequest = $loginRequest;
    }

    public function AcessarUsuario($login, $senha){
        $token = null;
        $resp = Http::post(env('API_URL')."Auth/authenticate", [
            "username" => $login,
            "password" => $senha
        ])->json();

        if(isset($resp['token'])){
            $token = $resp['token'];
            session(["usersession" => ["token" => $token, "name" => $login]]);
            session(["_apiToken" => $token]);
        }

        return $token;
    }

}