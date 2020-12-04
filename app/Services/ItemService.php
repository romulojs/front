<?php

namespace App\Services;

use App\Services\Interfaces\IItemService;

use App\Http\Request\ItemRequest;

use App\Models\Items\Items;
use App\Models\Items\Consumiveis;
use App\Models\Items\Criacoes;

class ItemService implements IItemService{

    protected $_itemRequest;
    private $_itemList;

    public function __construct(ItemRequest $itemRequest){
        $this->_itemRequest = $itemRequest;
        $this->_itemList = new Items;
    }

    public function GetAllItems(){
        $itemString = $this->_itemRequest->GetAllItems();

        foreach(json_decode($itemString) as $item){
            foreach($item->consumiveis as $consumivel){
                array_push($this->_itemList->consumiveis, new Consumiveis(
                    $consumivel->id,
                    $consumivel->nome,
                    $consumivel->desc,
                    $consumivel->valor,
                    $consumivel->atributo,
                    $consumivel->quantidade,
                    $consumivel->img
                ));
            }

            foreach($item->criacoes as $criacao){
                array_push($this->_itemList->criacoes, new Criacoes(
                    $criacao->id,
                    $criacao->nome,
                    $criacao->desc,
                    $criacao->quantidade,
                    $criacao->img
                ));
            }
        }

        return $this->_itemList;
    }

    public function GetItensConsumiveis(){

    }

    public function GetItensCriacoes(){

    }

}