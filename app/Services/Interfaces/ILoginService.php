<?php

namespace App\Services\Interfaces;

interface ILoginService{
    public function AcessarUsuario($login, $senha);
}