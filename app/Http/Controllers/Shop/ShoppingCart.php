<?php

namespace App\Http\Controllers\Shop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\SanPham;
use App\Models\HoaDon;
use App\Models\CongDoan;
use Illuminate\Support\Facades\Auth;

class ShoppingCart extends Controller
{
    private $data = [];
    
    private function createHD($request){
        return Auth::User()->HoaDon()->create([
            'diachi' => $request->diachi,
            'sdt' => $request->sdt,
            'mota' => $request->mota
        ]);
    }

    private function createCTHD($hd, $listsp = array()){
        $cart = new Cart();
        foreach ($listsp as $idsp=>$sl){
            $hd->ChiTietHoaDon()->create([
                'sanpham_id' => $idsp,
                'loaikhuyenmai_id' => $cart->getLoaiKM($idsp),
                'soluong' => $sl,
                'gia' => SanPham::find($idsp)->gia
            ]);
        }
    }

    function muahang(Request $request){
        if (!Auth::check())
            return redirect()->route('login');

        $cart = new Cart();
        if (count($cart->getAll()) < 0){
            return redirect()->route('cart');
        }

        //validate
        $this->validate($request, [
            'diachi' => 'required|between:3,500',
            'sdt' => 'required|between:7,14',
        ]);

        //tính tiền
        $hd = $this->createHD($request);
        $this->createCTHD($hd, $cart->getAll());
        
        //cdhd
        $hd->CongDoanHoaDon()->create([
            'congdoan_id' => 1,
            'truongphong_id' => CongDoan::find(1)->PhongBan->TruongPhong->nhanvien_id,
        ]);
        $cart->deleteAll();
        return redirect()->route('order-detail', ['id' => $hd->id])->with('success', 'Bạn đã đặt hàng thành công');
    }

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
            "soluong" => $cart->SoLuong($request->id),
            "count" => count($cart->getAll()),
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
            "soluong" => $cart->SoLuong($request->id),
            "count" => count($cart->getAll()),
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
