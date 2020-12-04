<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\DashboardController;
use Illuminate\Http\Request;

use App\Services\LoginService;

class DefaultController extends Controller
{
    private $_loginService;

    public function __construct(LoginService $loginService){
        $this->_loginService = $loginService;
    }

    public function index(){
        return view("login", [
            'errorLogin' => false
        ]);
    }

    public function carregarUsuario(Request $req){
        $token = $this->_loginService->AcessarUsuario($req->login, $req->senha);
        
        if(!is_null($token)){
            return redirect()->route('home');
        }else{
            return redirect('/');
        }
    }
}