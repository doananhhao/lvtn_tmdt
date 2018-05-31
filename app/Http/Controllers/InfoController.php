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

    private function check_validator_detail(Request $request){
        return Validator::make($request->all(), [
            'phone_id' => 'required|exists:phone,id',
            'amount' => 'required|min:1',
            'order_id' => 'required|exists:orders,id',
        ]);
    }

    private function check_delivered($id){
        $order = Orders::find($id)->toArray;
        return $order['delivered'] == 1?true:false;
    }
    

    public function save_detail(Request $request){
        $validator = $this->check_validator_detail($request);

        $errors = $validator->errors()->toArray();
        
        $order_detail = Order_detail::find($request->order_detail_id);

        if ($validator->fails()){
            if (isset($errors['order_id']) || ($order_detail != null && $order_detail->order_id == $request->order_id))
                return redirect()->route('order_list');
        
            if ($request->order_detail_id == null)
                return redirect()->route('add_order_detail', ['order_id' => $request->order_id])->withErrors($validator)->withInput();

            if ($order_detail != null && $order_detail->order_id == $request->order_id)
                return redirect()->route('edit_order_detail', ['order_id' => $request->order_id, 'order_detail_id' => $request->order_detail_id])->withErrors($validator)->withInput();

            return redirect()->route('order_list');
        }

        if ($order_detail == null){
            $order_detail = new Order_detail(); 
        }
        if (Order_detail::where([['phone_id', $request->phone_id],['order_id', $request->order_id]])->first() != null){
            $order_detail = Order_detail::where([['phone_id', $request->phone_id],['order_id', $request->order_id]])->first();
        }

        $order_detail->order_id = $request->order_id;
        $order_detail->phone_id = $request->phone_id;
        $order_detail->amount = $request->amount;

        $order_detail->save();
        
        return redirect()->route('order_detail', ['id' => $request->order_id]);
        
    }

    public function edit_order_detail($order_id, $order_detail_id){
        // check chưa giao => tiếp
        if (Orders::find($order_id)->delivered == 1)
            return abort(404);
        if (Order_detail::find($order_detail_id) == null)
            return abort(404);
        $order = Orders::find($order_id);
        if ($order == null)
            return abort(404);

        $order = $order->toArray();

        $this->data['phone'] = Phone::all()->toArray();
        $this->data['titile'] = 'Admin - cập nhật chi tiết của đơn đặt hàng';
        $this->data['titile2'] = 'Cập nhật - Chi tiết dơn hàng Mã Số '.$order['id'];
        $this->data['order_id'] = $order['id'];
        $this->data['order_detail_info'] = Order_detail::find($order_detail_id)->toArray();
        return view('admin.content.add_order_detail', $this->data);
    }

   public function getInfo(){

        return view('shop.layouts.page.acc-info');
    }
    public function changePass(){

        return view('shop.layouts.page.change-pass');
    }

    public function list_order(){
        
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

    

    

    public function save_edit_order(Request $request){
        $validator = $this->check_validator_order($request);

        /**
         * Nếu đã thanh toán xong thì không được sửa hóa đơn
         */
        if (Orders::where([['id', $request->order_id], ['delivered', '1']])->first() == null)
            return abort(404);

        if ($validator->fails() || $request->order_id == null){
            if ($request->order_id == null)
                return redirect()->route('order_list');
            return redirect()->route('edit_order', ['id' => $request->order_id])->withErrors($validator)->withInput();
        }

        $this->save_order_f($request);
        return redirect()->route('order_list');
    }

    private function save_order_f(Request $request){
        $order = new Orders();
        if ($request->order_id != null)
            $order = Orders::find($request->order_id);
        $order->order_by = $request->order_by;
        $order->address = $request->address;
        $order->phone = $request->phone;
        /**
         * Vì function này được dùng khi lập hóa đơn mua trực tiếp nên ship = 0
         * Mua qua ship khi đặt hàng qua giỏ hàng (cart)
         */
        $order->ship = 0;
        $order->delivered = 0;
        $order->save();
    }

    private function check_validator_order(Request $request){
        return Validator::make($request->all(), [
            'order_id' => 'exists:orders,id',
            'order_by' => 'required|min:6',
            'address' => 'required|min:10',
            'phone' => 'required|numeric|min:7',
        ]);
    }

    
}
