<?php

namespace App\Http\Controllers;
use Session;
use App\Http\Controllers\Controller;

use App\Services\ItemService;

use App\Models\Request\HomeData;

class DashboardController extends Controller
{
    protected $_itemService;

    public function __construct(ItemService $itemService){
        $this->_itemService = $itemService;
    }

    public function home(){
        return view("dashboard.home");
    }

    public function DeslogarUsuarios(){
        Session::flush();
        return redirect('/');
    }
}
