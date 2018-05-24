<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShoppingCart extends Controller
{
    private $data = [];

    function index(){
        return view('shop.shopping-cart', $this->data);
    }
}
