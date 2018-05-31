<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\SanPham;

class ShoppingCart extends Controller
{
    private $data = [];
    
    function remove(Request $request){
        if ($request->id == null || SanPham::find($request->id) == null)
            return abort(404);
        $cart = new Cart();

        return response()->json([
            "success" => $cart->removeItem($request->id),
            "totalPrice" => number_format($cart->getTotalPrice(),0,',','.'),
            "count" => count($cart->getAll()),
        ]);
    }

    function add_to_cart(Request $request){
        if ($request->id == null || SanPham::find($request->id) == null)
            return abort(404);

        $cart = new Cart();

        if (!$cart->add($request->id)){
            return response()->json(["success" => false]);
        }

        $sp = SanPham::find($request->id);

        return response()->json([
            "success" => true,
            "product_URL" => route('chitietsanpham', ['tensp' => $sp->id]),
            "imageURL" => asset('shop/images/pic/mh_'.$sp->hinhanh),
            "product_name" => $sp->tensanpham,
            "price" => number_format($sp->gia,0,',','.'),
            "totalPrice" => number_format($cart->getTotalPrice(),0,',','.'),
            "id" => $sp->id,
            "count" => count($cart->getAll()),
        ]);
    }

    function cartMinus(Request $request){
        if ($request->id == null || SanPham::find($request->id) == null)
            return abort(404);

        $cart = new Cart();
        
        if (!$cart->reduceByOne($request->id)){
            return response()->json([
                "success" => false,
                "totalPrice" => number_format($cart->getTotalPrice(),0,',','.')
            ]);
        }

        $price = $cart->price($request->id);
        $totalPrice = $cart->getTotalPrice();

        $return = [
            "totalPrice" => number_format($totalPrice,0,',','.'), //tổng giá tất cả sp
            "price" => number_format($price,0,',','.'), //giá sp * số lượng * khuyến mãi
            "success" => true, //trạng thái của hàm (id có sai hay ko || id có trong vỏ hàng hay ko)
        ];
        
        return response()->json($return);
    }

    function cartPlus(Request $request){
        if ($request->id == null || SanPham::find($request->id) == null)
            return abort(404);

        $cart = new Cart();
        
        if (!$cart->plusByOne($request->id)){
            return response()->json([
                "success" => false,
                "totalPrice" => number_format($cart->getTotalPrice(),0,',','.')
            ]);
        }

        $price = $cart->price($request->id);
        $totalPrice = $cart->getTotalPrice();

        $return = [
            "totalPrice" => number_format($totalPrice,0,',','.'), //tổng giá tất cả sp
            "price" => number_format($price,0,',','.'), //giá sp * số lượng * khuyến mãi
            "success" => true, //trạng thái của hàm (id có sai hay ko || id có trong vỏ hàng hay ko)
        ];
        
        return response()->json($return);
    }

    function index(){
        return view('shop.shopping-cart', $this->data);
    }
}
