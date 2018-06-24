<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Hash;
use App\Models\HoaDon;
use App\Models\ChiTietHoaDon;
use App\Models\SanPham;
use App\Models\ThanhVien;
use App\Models\CapDo;
use App\Models\LoaiSP;
use App\Models\NhaCungCap;
use App\Models\DangBan;
use App\Models\DuyetDangBanHistory;
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
    

    public function getLevel(){
        $thanhvien = ThanhVien::where('user_id',Auth::user()->id)->get();
        $capdo = CapDo::all();
        
        $diemhientai=null;

        
        $this->data['thanhvien'] = $thanhvien; 
        $this->data['capdo'] = $capdo; 
        $this->data['diemhientai'] = $diemhientai; 
        
        return view('shop.layouts.page.level', $this->data);
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
        $order = HoaDon::where('id',$id)->get();
        $this->data['orders'] = $order; 

        
        $orders_detail = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->where('hoadon_id', $id)->get()->toArray();
        
        
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
            $order_list = HoaDon::where('user_id',Auth::user()->id)->where('isship', 1)->orderBy('id', 'desc')->get()->toArray();
        else
            $order_list = HoaDon::where('user_id',Auth::user()->id)->where('isship', 0)->orderBy('id', 'desc')->get()->toArray();
            
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.order-list', $this->data);
    }

    public function list_sell(){
        $this->data['dangban'] = DangBan::join('SanPham','SanPham.id','sanpham_id')->join('LoaiSP','LoaiSP.id','SanPham.loaisp_id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();


        return view('shop.layouts.page.sell-list',$this->data);
    }

    public function dangban_status($status){
        $status = strtolower($status);
        $list_status = ['all', 'complete', 'ongoing'];
        if (!in_array($status, $list_status))
            return abort(404);

        $this->data['status'] = $status;
        

        if ($status == 'all')
            $sell_list = DangBan::join('DuyetDangBanHistory','DangBan.id','dangban_id')->join('SanPham','SanPham.id','sanpham_id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();
        else if ($status == 'complete')
            $sell_list = DangBan::join('DuyetDangBanHistory','DangBan.id','dangban_id')->join('SanPham','SanPham.id','sanpham_id')->where('DangBan.thanhvien_id',Auth::user()->id)->where('status', 1)->orderBy('DangBan.id', 'desc')->get()->toArray();
        else
            $sell_list = DangBan::join('DuyetDangBanHistory','DangBan.id','dangban_id')->join('SanPham','SanPham.id','sanpham_id')->where('DangBan.thanhvien_id',Auth::user()->id)->where('status', 0)->orderBy('DangBan.id', 'desc')->get()->toArray();
            
        $this->data['dangban'] = $sell_list; 

        return view('shop.layouts.page.sell-list', $this->data);
    }

    public function sell(){
        $this->data['loaisp'] = LoaiSP::all();
        $this->data['ncc'] = NhaCungCap::all();

        return view('shop.layouts.page.sell',$this->data);
    }

    public function sellinfo($id){
        if (SanPham::find($id) == null)
            return abort(404);
        $sanphamdb = SanPham::where('id',$id)->first();
        $history=array();
        $historya = DangBan::join('DuyetDangBanHistory','DangBan.id','dangban_id')->join('SanPham','SanPham.id','sanpham_id')->where('DangBan.sanpham_id',$id)->get();
        
        foreach($historya as $ht)
        {
            
            if($ht->isfix == 0){
                $history=$ht;
            }
        }

        return view('shop.layouts.page.sell-info',compact('sanphamdb','history'));
    }

    public function sell_product(Request $request){
        $this->validate($request, [
            'tensanpham' => 'required|between:3,191',
            'gia' => 'required|integer|min:0',
            'soluong' => 'required|numeric|min:0',
            'loaisp' => 'required|exists:loaisp,id',
            'ncc' => 'required|exists:nhacungcap,id',
            'mota' => 'max:10000',
        ]);

        $spdb=SanPham::create([
            'tensanpham' => $request->tensanpham,
            'gia' => $request->gia,
            'soluong' => $request->soluong,
            'loaisp_id' => $request->loaisp,
            'nhacungcap_id' => $request->ncc,
            'mota' => $request->mota,
            'hinhanh' => 'abc.jpg'
        ]);
        $spdb->save();
        $tvdb = ThanhVien::where('user_id',Auth::user()->id)->first();
        $iddangban=DangBan::create([
            'thanhvien_id' => $tvdb->user_id,
            'sanpham_id' => $spdb->id,
            // 'ngayhethan' => date('Y-m-d H:i:s'),
            'canduyet' => 1,
            'ngungban' => 0
        ]);

        DuyetDangBanHistory::create([
            'dangban_id' => $iddangban->id,
            'status' => 0,
            'ischeck' => 0,
            'isfix' => 0
        ]);

        return back()->with('success', 'Bạn đã đăng bán sản phẩm thành công, sản phẩm sẽ được cập nhật sau khi người kiểm duyệt thông qua.'.$request->tensanpham)->withInput();
    }

    

    public function sell_edit($id){
        $this->data['loaisp'] = LoaiSP::all();
        $this->data['ncc'] = NhaCungCap::all();
        $this->data['sanphamdangban'] = SanPham::where('id',$id)->first();

        return view('shop.layouts.page.sell-edit',$this->data);
    }

    public function save_edit_sell(Request $request,$id){

		$this->validate($request, [
            'tensanpham' => 'required|between:3,191',
            'gia' => 'required|integer|min:0',
            'soluong' => 'required|numeric|min:0',
            'loaisp' => 'required|exists:loaisp,id',
            'ncc' => 'required|exists:nhacungcap,id',
            'mota' => 'max:10000',
        ]);

        $sanpham = SanPham::find($id);
        
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->gia = $request->gia;
        $sanpham->soluong = $request->soluong;
        $sanpham->loaisp_id = $request->loaisp;
        $sanpham->nhacungcap_id = $request->ncc;
        $sanpham->mota = $request->mota;
        $sanpham->save();


        
        $iddangbana = DangBan::join('DuyetDangBanHistory','DangBan.id','dangban_id')->join('SanPham','SanPham.id','sanpham_id')->where('DangBan.sanpham_id',$id)->where('DuyetDangBanHistory.isfix','0')->get();
        

        $iddangban=array();
        foreach($iddangbana as $vl)
        {
            
            if($vl->isfix == 0){
                $iddangban=$vl;
            }
        }
        
        $setisfix = DuyetDangBanHistory::where('dangban_id',$iddangban['dangban_id'])->where('isfix','0')->first();
        
        $setisfix->isfix = 1;
        $setisfix->save();
        //dd($setisfix);
        DuyetDangBanHistory::create([
            'dangban_id' => $iddangban['dangban_id'],
            'status' => 0,
            'ischeck' => 0,
            'isfix' => 0
        ]);
        
        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->tensanpham)->withInput();
    }

    
}
