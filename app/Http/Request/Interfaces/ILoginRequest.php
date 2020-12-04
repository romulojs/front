<?php

namespace App\Http\Request\Interfaces;

interface ILoginRequest{
    public function LogarUsuario($login, $senha);
}