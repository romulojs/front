<?php

namespace App\Models\Request;

use App\Models\Items\Items;

class HomeData{
    public $items;
    public $user;

    public function __construct($user, $items){
        $this->user = $user;

        $this->items = $items;
    }
}