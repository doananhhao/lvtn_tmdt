<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\SanPham;
use Illuminate\Support\Facades\Auth;

class InfoController extends Controller
{
    protected $data = array();

    function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        /*
         * titile, chartjs, titile2
         */
        
         
         return redirect()->route('order_list');
         
    }

    

    

    private function generateRandomString($length = 5) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        $randomString = strtoupper($randomString);
        return $randomString;
    }

    
    
    /**
     * CÁC HÀM XỬ LÝ CỦA Order
     */


    
    

    public function save_edit_user(Request $request){

		$this->validate($request, [
				
            'hoten'  => 'required|min:3',
            'diachi' => 'required|min:3',
            'sdt'     => 'required|min:10|max:11',
            
        ]);

        $sanpham = Auth::user();
        $sanpham->name = $request->hoten;
        $sanpham->diachi = $request->diachi;
        $sanpham->sdt = $request->sdt;
       
        $sanpham->save();

        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->tensanpham)->withInput();
    }

    

   

   public function getInfo(){
       
        return view('shop.layouts.page.acc-info');
    }
    public function changePass(){

        return view('shop.layouts.page.change-pass');
    }

    public function getLevel(){

        return view('shop.layouts.page.level');
    }

    public function list_order_cancel(){
        $order_list = HoaDon::where('user_id',Auth::user()->id)->get()->toArray();
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.cancel-order-list', $this->data);
    }

    public function order_detail_cancel($id){
        

        
        $orders_detail = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->where('hoadon_id', $id)->get()->toArray();;
        
        
        $this->data['orders_detail'] = $orders_detail;
       

        return view('shop.layouts.page.cancel-order-detail', $this->data);
    }

    public function list_order(){
        // $total_price=0;
        // $orders_totalprice = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->join('HoaDon','HoaDon.id','hoadon_id')->where('HoaDon.user_id', Auth::user()->id)->get()->toArray();;
        // foreach ($orders_totalprice as $key=>$value){
        //     $total_price += $value['soluong']*$value['gia'];
        // }
        // $this->data['total_price'] = $total_price;

        $order_list = HoaDon::where('user_id',Auth::user()->id)->get()->toArray();
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.order-list', $this->data);
    }

    public function order_detail($id){
        

        
        $orders_detail = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->where('hoadon_id', $id)->get()->toArray();;
        
        
        $this->data['orders_detail'] = $orders_detail;
       

        return view('shop.layouts.page.order-detail', $this->data);
    }

    public function order_status($status){
        $status = strtolower($status);
        $list_status = ['all', 'complete', 'ongoing'];
        if (!in_array($status, $list_status))
            return abort(404);

        $this->data['status'] = $status;
        

        if ($status == 'all')
            $order_list = HoaDon::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        else if ($status == 'complete')
            $order_list = HoaDon::where('user_id',Auth::user()->id)->where('tinhtrang', 1)->orderBy('id', 'desc')->get()->toArray();
        else
            $order_list = HoaDon::where('user_id',Auth::user()->id)->where('tinhtrang', 0)->orderBy('id', 'desc')->get()->toArray();
            
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.order-list', $this->data);
    }

    public function set_order_complete($id){
        $order = Orders::find($id);
        $order_list = Order_detail::where('order_id', $id)->get()->toArray();

        if ($order == null || $order->delivered == 1)
            return abort(404);
        if (count($order_list) == 0)
            exit('Chưa có sản phẩm nào trong đơn hàng');
        
        $order->delivered = 1;
        $order->save();
        return redirect()->route('order_list');
    }

    public function set_order_ongoing($id){
        $order = Orders::find($id);
        if ($order == null)
            return abort(404);

        $order->delivered = 0;
        $order->save();
        return redirect()->route('order_list');
    }

    

    

    

    

    
}
