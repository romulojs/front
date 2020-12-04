<?php

namespace App\Models\Items;

class Consumiveis{
    public $id;
    public $nome;
    public $desc;
    public $valor;
    public $atributo;
    public $quantidade;
    public $img;

    public function __construct($id, $nome, $desc, $valor, $atributo, $quantidade, $img){
        $this->id = $id;
        $this->nome = $nome;
        $this->desc = $desc;
        $this->valor = $valor;
        $this->atributo = $atributo;
        $this->quantidade = $quantidade;
        $this->img = $img;
    }
}