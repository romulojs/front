<?php

namespace App\Models\Items;

class Criacoes{
    public $id;
    public $nome;
    public $desc;
    public $quantidade;
    public $img;

    public function __construct($id, $nome, $desc, $quantidade, $img){
        $this->id = $id;
        $this->nome = $nome;
        $this->desc = $desc;
        $this->quantidade = $quantidade;
        $this->img = $img;
    }
}