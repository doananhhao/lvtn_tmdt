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
use App\Models\DaiLy;
use App\Models\NhaCungCap;
use App\Models\DangBan;
use App\Models\DuyetDangBanHistory;
use App\Models\CongDoanHoaDon;
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


    
    

    



    //Hiện menu Đại lý nếu có
    // public function getNavBar(){
    //     $daily = ThanhVien::join('CapDo','ThanhVien.capdo_id','CapDo.id')->join('DaiLy','ThanhVien.user_id','DaiLy.thanhvien_id')->where('user_id',Auth::user()->id)->first();
    //     //$this->data['daily'] = $daily; 
    //     return view('shop.layouts.page.info', compact('daily'));
    // }

   
    //Thông tin tài khoản
   public function getInfo(){
    $this->data['title'] = "Thông tin tài khoản";
    $this->data['title2'] = 'Thông tin tài khoản';
        return view('shop.layouts.page.acc-info',$this->data);
    }
    
    //Edit thông tin tài khoản
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

    public function getLevel(){
        $this->data['title'] = "Thông tin thành viên";
        $thanhvien = ThanhVien::join('CapDo','ThanhVien.capdo_id','CapDo.id')->where('user_id',Auth::user()->id)->get();
        $capdo = CapDo::all();
        $daily = ThanhVien::join('CapDo','ThanhVien.capdo_id','CapDo.id')->join('DaiLy','ThanhVien.user_id','DaiLy.thanhvien_id')->where('user_id',Auth::user()->id)->first();
        //dd($thanhvien);
        $diemhientai=null;

        $this->data['daily'] = $daily; 
        $this->data['thanhvien'] = $thanhvien; 
        $this->data['capdo'] = $capdo; 
        $this->data['diemhientai'] = $diemhientai; 
        
        return view('shop.layouts.page.level', $this->data);
    }

    public function create_daily($id){

        if ($id == null)
            return abort(404);

        if (Auth::User()->ThanhVien == null)
            return abort(404);

        if (Auth::User()->ThanhVien->diemtichluy < CapDo::find(3)->diem)
            return abort(404);
        
        if (Auth::User()->ThanhVien->daily != null)
            return abort(404);
        

		$str = Auth::user()->id.Auth::user()->name;
        DaiLy::create([
            'thanhvien_id' => $id,
            'hash' => Hash::make($str)
        ]);

        $lencap = ThanhVien::where('user_id',$id)->first();
        $capdo = CapDo::all();
        
        foreach($capdo as $lv)
        {
            if($lencap->diemtichluy >= $lv->diem){
                $lencap->capdo_id = $lv->id;
            }
        }
        $lencap->save();
        
        return back()->with('success', 'Bạn đã trở thành Đại lý bán hàng, bạn có thể đăng bán sản phẩm của mình.')->withInput();
    }

    public function list_order_cancel(){
        $this->data['title'] = "Danh sách đơn hàng hủy";
        $order_list = HoaDon::where('user_id',Auth::user()->id)->get()->toArray();
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.cancel-order-list', $this->data);
    }

    public function order_detail_cancel($id){

        if (HoaDon::find($id) == null)
            return abort(404);

        $this->data['title'] = "Chi tiết đơn hàng hủy";

        
        $orders_detail = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->where('hoadon_id', $id)->get()->toArray();;
        
        
        $this->data['orders_detail'] = $orders_detail;
       

        return view('shop.layouts.page.cancel-order-detail', $this->data);
    }

    public function list_order(){
        $this->data['title'] = "Danh sách đơn hàng";
        // $total_price=0;
        // $orders_totalprice = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->join('HoaDon','HoaDon.id','hoadon_id')->where('HoaDon.user_id', Auth::user()->id)->get()->toArray();;
        // foreach ($orders_totalprice as $key=>$value){
        //     $total_price += $value['soluong']*$value['gia'];
        // }
        // $this->data['total_price'] = $total_price;

        $order_lists = HoaDon::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
        //$order_list = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->orderBy('HoaDon.id', 'desc')->get()->toArray();
        //
        $congdoan=CongDoanHoaDon::orderBy('id', 'desc')->get();
        $order_list=array();
            foreach($order_lists as $a){
                    foreach($congdoan as $s){
                        if($a['id'] == $s['hoadon_id']){
                            $x = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->where('CongDoanHoaDon.id',$s['id'])->first();
                            array_push($order_list,$x);
                            break;
                        }
                    }
            }
                        
        //
        //dd($order_list);
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.order-list', $this->data);
    }

    public function order_detail($id){
        if (HoaDon::find($id) == null)
            return abort(404);

        $this->data['title'] = "Chi tiết hóa đơn";
        $order = CongDoanHoaDon::where('hoadon_id',$id)->orderBy('id','desc')->first();
        $this->data['orders'] = $order; 
        
        $orders_detail = SanPham::join('ChiTietHoaDon','SanPham.id','sanpham_id')->where('hoadon_id', $id)->get()->toArray();
        
        
        $this->data['orders_detail'] = $orders_detail;
       

        return view('shop.layouts.page.order-detail', $this->data,compact('order'));
    }

    public function order_status($status){
        $status = strtolower($status);
        $list_status = ['all', 'complete', 'ongoing'];
        if (!in_array($status, $list_status))
            return abort(404);

        $this->data['status'] = $status;
        

        if ($status == 'all'){
            $this->data['title'] = "Danh sách đơn hàng";
            //$order_list = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->orderBy('HoaDon.id', 'desc')->get()->toArray();
            $order_lists = HoaDon::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
            //
            $congdoan=CongDoanHoaDon::orderBy('id', 'desc')->get();
            $order_list=array();
                foreach($order_lists as $a){
                        foreach($congdoan as $s){
                            if($a['id'] == $s['hoadon_id']){
                                $x = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->where('CongDoanHoaDon.id',$s['id'])->first();
                                array_push($order_list,$x);
                                break;
                            }
                        }
                }
            }
            else if ($status == 'complete'){
                $this->data['title'] = "Danh sách đơn hàng";
            //$order_list = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('congdoan_id',3)->where('user_id',Auth::user()->id)->where('status', 1)->orderBy('HoaDon.id', 'desc')->get()->toArray();
            $order_lists = HoaDon::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
            //
            $congdoan=CongDoanHoaDon::orderBy('id', 'desc')->get();
            $order_listx=array();
                foreach($order_lists as $a){
                        foreach($congdoan as $s){
                            if($a['id'] == $s['hoadon_id']){
                                $x = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->where('CongDoanHoaDon.id',$s['id'])->first();
                                array_push($order_listx,$x);
                                break;
                            }
                        }
                }
            //
            $order_list=array();
                foreach($order_listx as $a){
                    if(($a['congdoan_id'] == 3) && ($a['status'] == 1)){
                        array_push($order_list,$a);
                    }    
                }
            
            }
            else{
                $this->data['title'] = "Danh sách đơn hàng";
            //$order_list = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->where('dahuy', 0)->orderBy('HoaDon.id', 'desc')->get()->toArray();
            $order_lists = HoaDon::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->get()->toArray();
            //
            $congdoan=CongDoanHoaDon::orderBy('id', 'desc')->get();
            $order_listx=array();
                foreach($order_lists as $a){
                        foreach($congdoan as $s){
                            if($a['id'] == $s['hoadon_id']){
                                $x = CongDoanHoaDon::join('HoaDon','CongDoanHoaDon.hoadon_id','HoaDon.id')->where('user_id',Auth::user()->id)->where('CongDoanHoaDon.id',$s['id'])->first();
                                array_push($order_listx,$x);
                                break;
                            }
                        }
                }
            //
            $order_list=array();
                foreach($order_listx as $a){
                    if(($a['congdoan_id'] == 3 && $a['status'] == 0) || $a['congdoan_id'] != 3){
                        array_push($order_list,$a);

                    }    
                }
           
            } //dd($order_list);
        $this->data['orders'] = $order_list; 
        
        return view('shop.layouts.page.order-list', $this->data);
    }

    public function list_sell(){
        $this->data['title'] = "Danh sách sản phẩm";
        $this->data['statusdb'] = DangBan::join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('thanhvien_id',Auth::user()->id)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();
        
        $this->data['dangban'] = SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();
        
        //$this->data['dangbana'] = SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();

        //dd($this->data['dangban']);

        return view('shop.layouts.page.sell-list',$this->data);
    }

    public function dangban_status($status){
        $status = strtolower($status);
        $list_status = ['all', 'complete', 'ongoing'];
        if (!in_array($status, $list_status))
            return abort(404);

        $this->data['status'] = $status;
        

        if ($status == 'all'){
            $this->data['title'] = "Danh sách sản phẩm";
            $sell_list = SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();
            $sell_stt = DangBan::join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('thanhvien_id',Auth::user()->id)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();
        }
        else if ($status == 'complete'){
            $this->data['title'] = "Danh sách sản phẩm";
            // $sell_list = SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('DangBan.thanhvien_id',Auth::user()->id)->where('DuyetDangBanHistory.status', 1)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();
            $sell_stt = DangBan::join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('thanhvien_id',Auth::user()->id)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();
            $sell_list=array();
            $all= SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();
            foreach($all as $a){
                    foreach($sell_stt as $s){
                        if($a['id'] == $s['dangban_id']){
                            if($s['status'] == 1){
                                array_push($sell_list,$a);
                                
                            }break;
                        }
                    
                    }
                
            }
        }
        else{
            $this->data['title'] = "Danh sách sản phẩm";
            $sell_stt = DangBan::join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('thanhvien_id',Auth::user()->id)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();
            $sell_list=array();
            $all= SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();
            
            foreach($all as $a){
                if($a['canduyet']==1){
                    array_push($sell_list,$a);
                }
                else{
                    foreach($sell_stt as $s){
                        if($a['id'] == $s['dangban_id']){
                            if($s['status'] == 0){
                                array_push($sell_list,$a);
                                
                            }break;
                        }
                    
                    }
                }
                
            }
        }    
        $this->data['dangban'] = $sell_list; 
        $this->data['statusdb']=$sell_stt;

        return view('shop.layouts.page.sell-list', $this->data);
    }

    public function sell(){
        $this->data['title'] = "Đăng bán sản phẩm";
        $this->data['loaisp'] = LoaiSP::all();
        $this->data['ncc'] = NhaCungCap::all();

        return view('shop.layouts.page.sell',$this->data);
    }

    public function sellinfo($id){
        $this->data['title'] = "Thông tin sản phẩm";
        if (SanPham::find($id) == null)
            return abort(404);
        $sanphamdb = SanPham::where('id',$id)->first();
        $dangban = DangBan::where('sanpham_id',$id)->first();
        
        $history = DangBan::find($dangban->id)->DuyetDangBanHistory()->orderBy('id', 'desc')->first();
        //dd($dangban);
        return view('shop.layouts.page.sell-info',compact('sanphamdb','dangban','history'),$this->data);
    }
    
    public function sell_product(Request $request){
        $this->validate($request, [
            'tensanpham' => 'required|between:3,191',
            'gia' => 'required|integer|min:0',
            'soluong' => 'required|numeric|min:0',
            'loaisp' => 'required|exists:loaisp,id',
            'ncc' => 'required|exists:nhacungcap,id',
            'mota' => 'max:10000',
            'thoigian' => 'required',
            'img1' => 'required|image|dimensions:min_width=195,min_height=243',
        ]);

        //Kiểm tra ngày bd và kết thúc
        $thoigian = $request->thoigian;
        $thoigian = str_replace('/', '-',$thoigian);
        
        /* if (strpos($thoigian, ' - ') !== false)
            $arr = explode(' - ', $thoigian);
        else{
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        } */
        try{
            $ngaybd = date('Y-m-d');
            $ngayketthuc = date('Y-m-d', strtotime($thoigian));
        }catch(Exception $e){
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        }

        if ($ngaybd >= $ngayketthuc)
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        //Kiểm tra ngày bd và kết thúc

        $spdb= SanPham::create([
            'tensanpham' => $request->tensanpham,
            'gia' => $request->gia,
            'soluong' => $request->soluong,
            'loaisp_id' => $request->loaisp,
            'nhacungcap_id' => $request->ncc,
            'mota' => $request->mota,
            'hinhanh' => 'abc.png'
        ]);
        $spdb->hinhanh = changeTitle($spdb->tensanpham)."_".$spdb->id.".png";
        $request->file('img1')->move('public/shop/images/pic/dangban', $spdb->hinhanh);
        $spdb->save();
        $tvdb = ThanhVien::where('user_id',Auth::user()->id)->first();
        $iddangban=DangBan::create([
            'thanhvien_id' => $tvdb->user_id,
            'sanpham_id' => $spdb->id,
            'ngayhethan' => $ngayketthuc,
            //'ngayhethan' => date('Y-m-d H:i:s', strtotime(date('Y-m-d H:i:s').'+ 30 days')),
            'canduyet' => 1,
            'ngungban' => 0
        ]);


        return back()->with('success', 'Bạn đã đăng bán sản phẩm thành công, sản phẩm sẽ được cập nhật sau khi người kiểm duyệt thông qua.'.$request->tensanpham)->withInput();
    }

    

    public function sell_edit($id){

        $sell_stt = DangBan::join('DuyetDangBanHistory','DuyetDangBanHistory.dangban_id','DangBan.id')->where('thanhvien_id',Auth::user()->id)->orderBy('DuyetDangBanHistory.id', 'desc')->get()->toArray();
            $sell_list=array();
            $all= SanPham::join('LoaiSP','SanPham.loaisp_id','LoaiSP.id')->join('DangBan','DangBan.sanpham_id','SanPham.id')->where('DangBan.thanhvien_id',Auth::user()->id)->orderBy('DangBan.id', 'desc')->get()->toArray();
            
            foreach($all as $a){
                if($a['ngungban']==0){
                    if($a['canduyet']==1){
                        array_push($sell_list,$a);
                    }
                    else{
                        foreach($sell_stt as $s){
                            if($a['id'] == $s['dangban_id']){
                                if($s['status'] == 0){
                                    array_push($sell_list,$a);
                                    
                                }break;
                            }
                        
                        }
                    }
                }
            }
            $err=false;
            foreach($sell_list as $kt){
                if ($kt['sanpham_id'] == $id)
                    $err=true;
            }
    
            if ($err == false)
                return abort(404);
        
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
            'mota' => 'max:10000',/* 
            'thoigian' => 'required' */
        ]);

        //Kiểm tra ngày bd và kết thúc
        /* $thoigian = $request->thoigian;
        $thoigian = str_replace('/', '-',$thoigian);
        
       
        try{
            $ngaybd = date('Y-m-d');
            $ngayketthuc = date('Y-m-d', strtotime($thoigian));
        }catch(Exception $e){
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày');
        }

        if ($ngaybd >= $ngayketthuc)
            return back()->withInput()->with('date_error', 'Vui lòng chọn lại ngày'); */
        //Kiểm tra ngày bd và kết thúc

        $sanpham = SanPham::find($id);
        
        $sanpham->tensanpham = $request->tensanpham;
        $sanpham->gia = $request->gia;
        $sanpham->soluong = $request->soluong;
        $sanpham->loaisp_id = $request->loaisp;
        $sanpham->nhacungcap_id = $request->ncc;
        $sanpham->mota = $request->mota;
        $sanpham->save();


        
        $dangban = DangBan::where('sanpham_id',$id)->first();
        $dangban->canduyet = 1;
        //$dangban->ngayhethan = $ngayketthuc;
        $dangban->save();
        
        
        return back()->with('success', 'Bạn đã cập nhật thành công '.$request->tensanpham)->withInput();
    }

    public function save_stop_sell(Request $request,$id){

        
        $dangban = DangBan::where('id',$id)->first();
        $dangban->ngungban = 1;
        $dangban->save();

        $history=DuyetDangBanHistory::create([
            'dangban_id' => $dangban->id,
            'comment' => 'Đại lý ngừng bán',
            'status' => 0
        ]);

        
        
        return back()->with('success', 'Bạn đã ngừng bán sản phẩm này'.$request->tensanpham)->withInput();
    }

    public function save_cont_sell(Request $request,$id){

        
        $dangban = DangBan::where('id',$id)->first();
        $dangban->ngungban = 0;
        $dangban->canduyet = 1;
        $dangban->save();

        
        
        
        return back()->with('success', 'Bạn vui lòng đợi phản hồi từ người kiểm duyệt cho sản phẩm này'.$request->tensanpham)->withInput();
    }

    public function getLink()
    {
        $this->data['title'] = "Tạo link giới thiệu sản phẩm";
        $this->data['dssp'] = SanPham::all();
        return view('shop.layouts.page.getlink',$this->data);
    }
    public function get_Link(Request $request)
    {
        //check sp idid
        $dl=DaiLy::where('thanhvien_id',Auth::user()->id)->first();
        $a=$request->sanpham_id;
        
        $request->link = $a;
        
        return back()->withInput()->with('linkhash', route('chitietsanpham', ['tensp' => $a]).'?hash='.$dl->hash);
    }
}
